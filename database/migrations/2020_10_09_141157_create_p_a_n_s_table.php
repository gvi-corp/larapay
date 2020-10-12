<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePANSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_a_n_s', function (Blueprint $table) {
            $table->id();
            $table->string("PAN",25)->unique();
            $table->string("name");
            $table->text("description");
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

           $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('p_a_n_s');
    }
}
