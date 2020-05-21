<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArmamentToCraftPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('armament_to_craft_pivot', function (Blueprint $table) {
            $table->id();

            $table->string('qty');
                        
            $table->unsignedBigInteger('space_craft_id');
            $table->foreign('space_craft_id')->references('id')->on('space_crafts')->onDelete('cascade')->onUpdate('cascade');
            
            $table->unsignedBigInteger('armament_id');
            $table->foreign('armament_id')->references('id')->on('armaments')->onDelete('cascade')->onUpdate('cascade');  
            
            $table->unique(['space_craft_id', 'armament_id']);

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
        Schema::dropIfExists('armament_to_craft_pivot');
    }
}
