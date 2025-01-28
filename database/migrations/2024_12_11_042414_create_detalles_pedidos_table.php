<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detalles_pedidos', function (Blueprint $table) {
            $table->id(); // Clave primaria
            $table->unsignedBigInteger('pedido_id'); // Relación con tabla pedidos
            $table->unsignedBigInteger('proyecto_id')->nullable(); // Relación con tabla proyectos, puede ser nulo
            $table->unsignedBigInteger('producto_id')->nullable(); // Relación con tabla productos, puede ser nulo
            $table->integer('cantidad'); // Cantidad de productos o proyectos
            $table->decimal('precio', 10, 2); // Precio unitario del producto o proyecto
            $table->decimal('subtotal', 10, 2); // Subtotal del pedido
            $table->timestamps(); // Campos created_at y updated_at

            // Llaves foráneas
            $table->foreign('pedido_id')->references('id_pedido')->on('pedidos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('proyecto_id')->references('id')->on('proyectos')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('producto_id')->references('id')->on('productos')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles_pedidos');
    }
};