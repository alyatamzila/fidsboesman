<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('flights', function (Blueprint $table) {
        $table->string('destinasi', 20)->change(); // atau lebih besar
    });
}

public function down()
{
    Schema::table('flights', function (Blueprint $table) {
        $table->string('destinasi', 10)->change(); // sesuaikan default sebelumnya
    });
}
};
