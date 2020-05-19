<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArmamentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('armaments', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('qty');

            $table->unsignedBigInteger('space_craft_id');
            $table->foreign('space_craft_id')->references('id')->on('space_crafts')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('armament');
    }
}
