<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('festius', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha_inicio_festiu');
            $table->timestamp('fecha_fin_festiu');
            $table->foreignId('curs_id')->constrained(); // Updated to reference 'curs' table
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('festius');
    }
};


