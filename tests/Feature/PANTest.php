<?php

namespace Tests\Feature;

use App\Models\Device;
use App\Models\DigitizedCard;
use App\Models\PAN;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PANTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_encroll_to_the_service()
    {

        $attributes = [
            "name" => $this->faker->unique()->name,
            "email" => $this->faker->unique()->email,
            "password" => $this->faker->password
        ];

        $attributes['password_confirmation'] = $attributes['password'];

        $this->post('register', $attributes);

        //handling password hashing => can't verify "random" hashing
        unset($attributes["password"]);
        unset($attributes["password_confirmation"]);

        $this->assertDatabaseHas('users', $attributes);

        $this->refreshDatabase();
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

        $pan_b_attributes = [
            "name" => $this->faker->unique()->words(5, true),
            "pan" => intval("51" . $this->faker->unique()->numerify(implode(array_fill(0, 14, '#')))),
            "description" => "PAN B",
            "user_id" => $user->id
        ];

        $pan_a = PAN::make($pan_a_attributes);
        $pan_b = PAN::make($pan_b_attributes);

        $pan_a->save();
        $pan_b->save();


        $this->assertDatabaseHas('p_a_n_s', $pan_a_attributes);
        $this->assertDatabaseHas('p_a_n_s', $pan_b_attributes);

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

        $device_a = Device::make($device_a_attributes);
        $device_b = Device::make($device_b_attributes);

        $device_a->save();
        $device_b->save();

        $this->assertDatabaseHas('devices', $device_a_attributes);
        $this->assertDatabaseHas('devices', $device_b_attributes);


        //Creating a Digitized Card with both a registered device and a registered PAN
        $dc_attributes = [
            "name" => $this->faker->unique()->words(5, true),
            "description" => "Digitized Card Example",
            "pan_id" => $pan_a->id,
            "device_id" => $device_a->id,
            //"user_id" => $user->id
        ];



        $this->actingAs($user)->post(route('digitized_card.store'), $dc_attributes)->dump();

        //return;


        $this->assertDatabaseHas('digitized_cards', $dc_attributes);

        $this->refreshDatabase();
    }

    /** @test */
    public function a_user_can_create_a_pan()
    {

        $user = User::factory()->create();

        $attributes = [
            "name" => $this->faker->unique()->words(5, true),
            "pan" => intval("51" . $this->faker->unique()->numerify(implode(array_fill(0, 14, '#')))),
            "description" => "Hello"
        ];

        $this->actingAs($user)->post(route('pan.store'), $attributes);
        $this->assertDatabaseHas('p_a_n_s', $attributes);
    }
}
