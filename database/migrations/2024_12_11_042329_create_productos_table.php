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
        Schema::create('productos', function (Blueprint $table) {
            $table->id(); // Clave primaria
            $table->string('nombre', 255); // Nombre del producto
            $table->text('descripcion'); // Descripción detallada del producto
            $table->unsignedBigInteger('id_categoria'); // Relación con tabla categorias
            $table->string('codigo_producto', 100)->unique(); // Código único del producto
            $table->decimal('precio', 10, 2); // Precio del producto
            $table->decimal('costo', 10, 2); // Costo unitario del producto
            $table->integer('stock'); // Cantidad disponible en inventario
            $table->integer('min_stock'); // Stock mínimo permitido
            $table->boolean('visible')->default(1); // Producto visible al público
            $table->string('imagen', 255)->nullable(); // URL de la imagen del producto
            $table->string('nombre_sucursal', 100);
            $table->string('direccion_sucursal', 100);
            $table->timestamps(); // Campos created_at y updated_at

            // Llave foránea
            $table->foreign('id_categoria')->references('id_categoria')->on('categorias')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
