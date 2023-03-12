<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('listas', function (Blueprint $table) {
            $table->id();
            $table->dateTime("fecha");
            $table->unsignedInteger("id_materia");
            $table->unsignedInteger("id_alumno");
            $table->foreign("id_materia")->references("id")->on("materias");
            $table->foreign("id_alumno")->references("id")->on("alumnos");
            $table->boolean("asistencia");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listas');
    }
};
