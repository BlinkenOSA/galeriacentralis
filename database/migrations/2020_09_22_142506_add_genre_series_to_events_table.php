<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGenreSeriesToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
			$table->smallInteger('series')->nullable();
		});
		Schema::table('event_translations', function(Blueprint $table) {
			$table->string('genre', 200)->nullable();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
			$table->dropColumn('series');
		});
		Schema::table('event_translations', function (Blueprint $table) {
			$table->dropColumn('genre');
        });
    }
}
