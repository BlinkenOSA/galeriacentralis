<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventsTables extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
			createDefaultTableFields($table);
			$table->string('curator', 200)->nullable();
			$table->text('artists')->nullable();
			$table->text('coop')->nullable();
			$table->text('partners')->nullable();
			$table->text('press')->nullable();
			$table->string('color', 10)->nullable();
        });

        Schema::create('event_translations', function (Blueprint $table) {
            createDefaultTranslationsTableFields($table, 'event');
            $table->string('title', 200)->nullable();
			$table->text('description')->nullable();
			$table->text('summary')->nullable();
        });

        Schema::create('event_slugs', function (Blueprint $table) {
            createDefaultSlugsTableFields($table, 'event');
        });

        
    }

    public function down()
    {
        
        Schema::dropIfExists('event_translations');
        Schema::dropIfExists('event_slugs');
        Schema::dropIfExists('events');
    }
}
