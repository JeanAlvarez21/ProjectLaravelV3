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
        Schema::create('inventario_productos', function (Blueprint $table) {
            $table->bigIncrements('id_inventario'); // Clave primaria
            $table->unsignedBigInteger('id_producto'); // Aseguramos que el tipo sea el mismo que en 'productos'
            $table->foreign('id_producto')->references('id_producto')->on('productos')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('cantidad_disponible');
            $table->string('nombre_sucursal', 100);
            $table->string('direccion_sucursal', 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventario_productos');
    }
};
