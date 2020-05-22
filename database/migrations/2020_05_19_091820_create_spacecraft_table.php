<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpacecraftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('space_crafts', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->text('image');
            $table->bigInteger('crew');
            $table->bigInteger('value');
            $table->string('status');

            $table->unsignedBigInteger('craft_types_id');
            $table->foreign('craft_types_id')->references('id')->on('crafttypes')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('spacecraft');
    }
}
