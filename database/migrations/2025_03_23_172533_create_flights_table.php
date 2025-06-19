<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('flight_no');
            $table->dateTime('schedule');
            $table->string('logo')->nullable();
            $table->enum('destinasi', ['ternate', 'labuha', 'manado', 'jakarta']);
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('flights');
    }
};
