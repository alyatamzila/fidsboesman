<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeScheduleColumnTypeInFlightsTable extends Migration
{
    public function up()
    {
        Schema::table('flights', function (Blueprint $table) {
            $table->time('schedule')->change();
        });
    }

    public function down()
    {
        Schema::table('flights', function (Blueprint $table) {
            $table->dateTime('schedule')->change(); // atau sesuaikan jika sebelumnya DATETIME
        });
    }
}
