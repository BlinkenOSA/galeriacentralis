<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePressItemsTables extends Migration
{
    public function up()
    {
        Schema::create('press_items', function (Blueprint $table) {
            createDefaultTableFields($table);
            $table->string('title', 200)->nullable();
			$table->dateTime('date')->nullable();
			$table->string('url')->nullable();
			$table->string('publication')->nullable();
			$table->foreignId('event_id')->nullable();
        });

        

        

        
    }

    public function down()
    {
        
        Schema::dropIfExists('press_items');
    }
}
