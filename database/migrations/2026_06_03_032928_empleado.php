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
        Schema::create('empleados', function (Blueprint $table) {

            $table->id();

            $table->string('nombres')->nullable();

            $table->string('apellidos')->nullable();

            $table->date('fecha_nacimiento')->nullable();

            $table->date('fecha_ingreso')->nullable();

            $table->decimal('salario', 10, 2);

            $table->boolean('estado');

            // RELACION CON CARGOS
            $table->foreignId('id_cargo')
                  ->constrained('cargos')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
