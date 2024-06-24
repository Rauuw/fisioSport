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
        Schema::create('rutina_ejercicio', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('accion');
            $table->date('fecha');
            $table->integer('tiempo_ejercicio')->nullable();
            $table->integer('cantidad_repeticiones')->nullable();
            $table->string('motivo')->nullable();

            $table->foreignId('rutina_id')->nullable()
            ->constrained('rutinas')
            ->cascadeOnUpdate()
            ->nullOnDelete();

            $table->foreignId('ejercicio_id')->nullable()
            ->constrained('ejercicio')
            ->cascadeOnUpdate()
            ->nullOnDelete();
            $table->foreignId('paciente_id')->nullable()->references('id')->on('pacientes')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rutina_ejercicios');
    }
};
