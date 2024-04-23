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
        Schema::create('paciente_historials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha_creaciom');
            $table->string('diagnostico');
            $table->string('sintomas');
            
            $table->foreignId('paciente_id')->nullable()
            ->constrained('pacientes')
            ->cascadeOnUpdate()
            ->nullOnDelete();

            $table->foreignId('historial_id')->nullable()
            ->constrained('historial')
            ->cascadeOnUpdate()
            ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paciente_historials');
    }
};
