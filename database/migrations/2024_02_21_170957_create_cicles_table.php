<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCiclesTable extends Migration
{
    public function up()
    {
        Schema::create('cicles', function (Blueprint $table) {
            $table->id();
            $table->string('nom_cicle');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cicles');
    }
}