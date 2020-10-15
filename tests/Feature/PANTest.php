<?php

namespace Tests\Feature;

use App\Models\Device;
use App\Models\DigitizedCard;
use App\Models\PAN;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PANTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_enroll_to_the_service()
    {

        $attributes = [
            "name" => $this->faker->unique()->name,
            "email" => $this->faker->unique()->email,
            "password" => $this->faker->password(8)
        ];

        $attributes['password_confirmation'] = $attributes['password'];

        $this->post('register', $attributes);

        //handling password hashing => can't verify "random" hashing
        unset($attributes["password"]);
        unset($attributes["password_confirmation"]);

        $this->assertDatabaseHas('users', $attributes);
    }

    /** @test */
    public function a_user_can_create_one_digitized_card()
    {
        $user = User::factory()->create();

        //Creating Means of Paiement
        $pan_a_attributes = [
            "name" => $this->faker->unique()->words(5, true),
            "pan" => intval("51" . $this->faker->unique()->numerify(implode(array_fill(0, 14, '#')))),
            "description" => "PAN A",
            "user_id" => $user->id
        ];

        $pan_a = PAN::create($pan_a_attributes);

        //$this->assertDatabaseHas('pans', $pan_a_attributes);
        //$this->assertDatabaseHas('pans', $pan_b_attributes);

        //Creating Devices
        $device_a_attributes = [
            "name" => $this->faker->unique()->words(5, true),
            "type" => "Smartphone",
            "os" => "iOS",
            "description" => "Device A",
            "user_id" => $user->id
        ];

        $device_a = Device::create($device_a_attributes);

        //$this->assertDatabaseHas('devices', $device_a_attributes);
        //$this->assertDatabaseHas('devices', $device_b_attributes);


        //Creating a Digitized Card with both a registered device and a registered PAN
        $dc_attributes = [
            "name" => $this->faker->unique()->words(5, true),
            "description" => "Digitized Card Example",
            "pan_id" => $pan_a->id,
            "device_id" => $device_a->id,
            //"user_id" => $user->id
        ];


        $this->actingAs($user)->post(route('digitized_card.store'), $dc_attributes);

        $this->assertDatabaseHas('digitized_cards', $dc_attributes);
    }

    /** @test */
    public function a_user_can_create_multiple_digitized_card()
    {
        $user = User::factory()->create();

        //Creating Means of Paiement
        $pan_a_attributes = [
            "name" => $this->faker->unique()->words(5, true),
            "pan" => intval("51" . $this->faker->unique()->numerify(implode(array_fill(0, 14, '#')))),
            "description" => "PAN A",
            "user_id" => $user->id
        ];

        $pan_b_attributes = [
            "name" => $this->faker->unique()->words(5, true),
            "pan" => intval("51" . $this->faker->unique()->numerify(implode(array_fill(0, 14, '#')))),
            "description" => "PAN B",
            "user_id" => $user->id
        ];

        $pan_a = PAN::create($pan_a_attributes);
        $pan_b = PAN::create($pan_b_attributes);

        $this->assertDatabaseHas('pans', $pan_a_attributes);
        $this->assertDatabaseHas('pans', $pan_b_attributes);

        //Creating Devices
        $device_a_attributes = [
            "name" => $this->faker->unique()->words(5, true),
            "type" => "Smartphone",
            "os" => "iOS",
            "description" => "Device A",
            "user_id" => $user->id
        ];

        $device_b_attributes = [
            "name" => $this->faker->unique()->words(5, true),
            "type" => "Tablet",
            "os" => "Android",
            "description" => "Device B",
            "user_id" => $user->id
        ];

        $device_a = Device::create($device_a_attributes);
        $device_b = Device::create($device_b_attributes);

        $this->assertDatabaseHas('devices', $device_a_attributes);
        $this->assertDatabaseHas('devices', $device_b_attributes);

        //Creating a Digitized Card with both a registered device and a registered PAN
        $dc_a_attributes = [
            "name" => $this->faker->unique()->words(5, true),
            "description" => "Digitized Card Example",
            "pan_id" => $pan_a->id,
            "device_id" => $device_a->id,
            //"user_id" => $user->id
        ];

        $dc_b_attributes = [
            "name" => $this->faker->unique()->words(5, true),
            "description" => "Digitized Card Example 2",
            "pan_id" => $pan_b->id,
            "device_id" => $device_b->id,
            //"user_id" => $user->id
        ];


        $this->actingAs($user)->post(route('digitized_card.store'), $dc_a_attributes);
        $this->actingAs($user)->post(route('digitized_card.store'), $dc_b_attributes);


        $this->assertDatabaseHas('digitized_cards', $dc_a_attributes);
        $this->assertDatabaseHas('digitized_cards', $dc_b_attributes);
    }

    /** @test */
    public function a_user_can_delete_one_digitized_card()
    {
        $user = User::factory()->create();

        //Creating Means of Paiement
        $pan_a_attributes = [
            "name" => $this->faker->unique()->words(5, true),
            "pan" => intval("51" . $this->faker->unique()->numerify(implode(array_fill(0, 14, '#')))),
            "description" => "PAN A",
            "user_id" => $user->id
        ];

        $pan_a = PAN::create($pan_a_attributes);

        //Creating Devices
        $device_a_attributes = [
            "name" => $this->faker->unique()->words(5, true),
            "type" => "Smartphone",
            "os" => "iOS",
            "description" => "Device A",
            "user_id" => $user->id
        ];

        $device_a = Device::create($device_a_attributes);

        //Creating a Digitized Card with both a registered device and a registered PAN
        $dc_a_attributes = [
            "name" => $this->faker->unique()->words(5, true),
            "description" => "Digitized Card Example",
            "pan_id" => $pan_a->id,
            "device_id" => $device_a->id,
            "user_id" => $user->id
        ];

        $dc_a = DigitizedCard::create($dc_a_attributes);

        $this->actingAs($user)->get(route('digitized_card.show', ['digitized_card' => $dc_a]))->assertSee($dc_a->name);
        $this->actingAs($user)->delete(route('digitized_card.show', ['digitized_card' => $dc_a]));

        $this->assertDatabaseMissing('digitized_cards', $dc_a_attributes);
    }

    /** @test */
    public function a_user_can_see_a_list_of_his_digitized_cards()
    {
//        $this->withoutExceptionHandling();
        $user = User::factory()->create();

        //Creating Means of Paiement
        $pan_a_attributes = [
            "name" => $this->faker->unique()->words(5, true),
            "pan" => intval("51" . $this->faker->unique()->numerify(implode(array_fill(0, 14, '#')))),
            "description" => "PAN A",
            "user_id" => $user->id
        ];

        $pan_b_attributes = [
            "name" => $this->faker->unique()->words(5, true),
            "pan" => intval("51" . $this->faker->unique()->numerify(implode(array_fill(0, 14, '#')))),
            "description" => "PAN B",
            "user_id" => $user->id
        ];

        $pan_a = PAN::create($pan_a_attributes);
        $pan_b = PAN::create($pan_b_attributes);

        $this->assertDatabaseHas('pans', $pan_a_attributes);
        $this->assertDatabaseHas('pans', $pan_b_attributes);

        //Creating Devices
        $device_a_attributes = [
            "name" => $this->faker->unique()->words(5, true),
            "type" => "Smartphone",
            "os" => "iOS",
            "description" => "Device A",
            "user_id" => $user->id
        ];

        $device_b_attributes = [
            "name" => $this->faker->unique()->words(5, true),
            "type" => "Tablet",
            "os" => "Android",
            "description" => "Device B",
            "user_id" => $user->id
        ];

        $device_a = Device::create($device_a_attributes);
        $device_b = Device::create($device_b_attributes);

        $this->assertDatabaseHas('devices', $device_a_attributes);
        $this->assertDatabaseHas('devices', $device_b_attributes);

        //Creating a Digitized Card with both a registered device and a registered PAN
        $dc_a_attributes = [
            "name" => $this->faker->unique()->words(5, true),
            "description" => "Digitized Card Example",
            "pan_id" => $pan_a->id,
            "device_id" => $device_a->id,
            "user_id" => $user->id
        ];

        $dc_b_attributes = [
            "name" => $this->faker->unique()->words(5, true),
            "description" => "Digitized Card Example 2",
            "pan_id" => $pan_b->id,
            "device_id" => $device_b->id,
            "user_id" => $user->id
        ];


        $dc_a = DigitizedCard::create($dc_a_attributes);
        $dc_b = DigitizedCard::create($dc_b_attributes);

        $dcs = [
            $dc_a,
            $dc_b
        ];

        foreach ($dcs as $dc){
            $this->actingAs($user)->get(route('digitized_card.index'))->assertSee($dc->name);
        }
    }

    /** @testx */
    public function a_user_can_create_a_pan()
    {

        $user = User::factory()->create();

        $attributes = [
            "name" => $this->faker->unique()->words(5, true),
            "pan" => intval("51" . $this->faker->unique()->numerify(implode(array_fill(0, 14, '#')))),
            "description" => "Hello"
        ];

        $this->actingAs($user)->post(route('pan.store'), $attributes);

        $this->assertDatabaseHas('pans', $attributes);

        //$this->refreshDatabase();
    }
}
