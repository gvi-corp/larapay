<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->unsignedDecimal('amount');
            $table->enum('currency',['Euros','USD','GBP']);
            $table->string('seller');

            $table->unsignedBigInteger('digitized_card_id');
            $table->unsignedBigInteger('user_id');

            $table->text('description')->nullable()->default('');

            $table->foreign('digitized_card_id')->references('id')->on('digitized_cards');
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
