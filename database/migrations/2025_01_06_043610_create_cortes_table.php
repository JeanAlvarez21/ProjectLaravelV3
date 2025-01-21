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
        Schema::create('cortes', function (Blueprint $table) {
            $table->id(); // Clave primaria
            $table->unsignedBigInteger('id_producto'); // Relación con productos
            $table->unsignedBigInteger('proyecto_id'); // Relación con proyectos
            $table->integer('cantidad'); // Cantidad de cortes
            $table->string('medidas', 255); // Dimensiones del corte
            $table->string('tipo_borde', 100); // Tipo de borde
            $table->string('color_borde', 100); // Color del borde
            $table->string('descripcion_corte', 255)->nullable(); // Descripción adicional del corte
            $table->decimal('precio_total', 10, 2); // Precio total del corte
            $table->timestamp('fecha_corte')->nullable(); // Fecha del corte
            $table->timestamps(); // created_at y updated_at

            // Relaciones (Llaves foráneas)
            $table->foreign('id_producto')
                ->references('id') // Clave primaria de productos
                ->on('productos')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('proyecto_id')
                ->references('id') // Clave primaria de proyectos
                ->on('proyectos')
                ->onUpdate('cascade')
                ->onDelete('cascade'); // Eliminar cortes si el proyecto es eliminado
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cortes');
    }
};
