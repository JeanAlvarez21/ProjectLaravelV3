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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id(); // Clave primaria
            $table->string('nombre', 255); // Nombre del proyecto
            $table->string('ciudad', 100); // Ciudad del proyecto
            $table->string('local', 100); // Local asociado
            $table->unsignedBigInteger('id_producto'); // Relación con productos
            $table->enum('estado', ['Nuevo', 'En proceso', 'Terminado'])->default('Nuevo'); // Estado del proyecto
            $table->timestamps(); // created_at y updated_at
        
            // Llave foránea corregida
            $table->foreign('id_producto')
                  ->references('id') // Cambia 'id_producto' por 'id'
                  ->on('productos')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
