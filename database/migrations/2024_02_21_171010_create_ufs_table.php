<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUfsTable extends Migration
{
    public function up()
    {
        Schema::create('ufs', function (Blueprint $table) {
            $table->id();
            $table->string('nom_uf');
            $table->integer('hores_dilluns');
            $table->integer('hores_dimarts');
            $table->integer('hores_dimecres');
            $table->integer('hores_dijous');
            $table->integer('hores_divendres');
            $table->foreignId('id_modul')->constrained('moduls');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ufs');
    }
}