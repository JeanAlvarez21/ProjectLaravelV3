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
        Schema::create('facturacions', function (Blueprint $table) {
            $table->bigIncrements('id_facturacion'); // Clave primaria
            $table->unsignedBigInteger('id_pedido'); // Aseguramos que el tipo sea el mismo que en 'pedidos'
            $table->foreign('id_pedido')->references('id_pedido')->on('pedidos')->onUpdate('cascade')->onDelete('cascade');
            $table->string('metodo_pago', 50);
            $table->text('datos_factura');
            $table->string('estado_factura', 50);
            $table->dateTime('fecha_creacion');
            $table->unsignedBigInteger('creado_por');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturacions');
    }
};
