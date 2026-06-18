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
        Schema::create('funciones_cargo', function (Blueprint $table) {

            $table->id();

            $table->text('descripcion_funcion');

            $table->string('estado');

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
        Schema::dropIfExists('funciones_cargo');
    }
};
