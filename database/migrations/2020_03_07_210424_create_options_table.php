<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOptionsTable extends Migration
{
	public function up()
	{
		Schema::create('options', function (Blueprint $table) {
			createDefaultTableFields($table);
			$table->text('options')->nullable();
		});

		Schema::create('option_translations', function (Blueprint $table) {
			createDefaultTranslationsTableFields($table, 'option');
			$table->string('title', 200)->nullable();
		});

		Schema::create('option_slugs', function (Blueprint $table) {
			createDefaultSlugsTableFields($table, 'option');
		});

		
	}

	public function down()
	{
		
		Schema::dropIfExists('option_translations');
		Schema::dropIfExists('option_slugs');
		Schema::dropIfExists('options');
	}
}
