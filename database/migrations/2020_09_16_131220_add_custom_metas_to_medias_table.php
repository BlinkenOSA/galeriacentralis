<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomMetasToMediasTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('medias')) {
            Schema::table('medias', function (Blueprint $table) {
                $table->smallInteger('frontpage')->nullable();
                $table->string('credit')->nullable();
            });
        }
    }
    public function down()
    {
        if (Schema::hasTable('medias')) {
            Schema::table('medias', function (Blueprint $table) {
                $table->dropColumn('frontpage');
                $table->dropColumn('credit');
            });
        }
    }
}