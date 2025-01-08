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
        Schema::create('detalles_pedidos', function (Blueprint $table) {
            $table->bigIncrements('id_detalle'); // Clave primaria
            $table->unsignedBigInteger('id_pedido'); // Aseguramos que el tipo sea el mismo que en 'pedidos'
            $table->unsignedBigInteger('id_producto'); // Aseguramos que el tipo sea el mismo que en 'productos'
            $table->foreign('id_pedido')->references('id_pedido')->on('pedidos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_producto')->references('id_producto')->on('productos')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('cantidad');
            $table->decimal('subtotal', 10, 2);
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
