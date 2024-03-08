<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('curs', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_curs');
            $table->timestamp('fecha_inicio_curs');
            $table->timestamp('fecha_fin_curs');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('curs');
    }
};

