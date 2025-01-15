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
        Schema::create('facturas', function (Blueprint $table) {
            $table->bigIncrements('id_facturacion'); // Clave primaria
            $table->unsignedBigInteger('id_pedido'); // Aseguramos que el tipo sea el mismo que en 'pedidos'
            $table->foreign('id_pedido')->references('id_pedido')->on('pedidos')->onUpdate('cascade')->onDelete('cascade');
            $table->string('metodo_pago', 50);
            $table->text('datos_factura');
            $table->string('estado_factura', 50);
            $table->timestamp('fecha_factura');
            $table->unsignedBigInteger('creado_por');
            $table->foreign('creado_por')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade'); // Cambiado a cascade
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas'); // Corregido el nombre de la tabla
    }
};