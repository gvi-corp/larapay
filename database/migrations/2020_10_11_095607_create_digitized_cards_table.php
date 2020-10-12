<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDigitizedCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('digitized_cards', function (Blueprint $table) {
            $table->id();

            $table->string("PAN",25)->unique();
            $table->string("name");
            $table->text("description");
            $table->unsignedBigInteger('user_id');
            //for redundant untransitive relation
            $table->unsignedBigInteger('pan_id');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            //redundant untransitive relation
            $table->foreign('pan_id')->references('id')->on('pan');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('digitized_cards');
    }
}
