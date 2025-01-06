<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id('id_inventario');
            $table->unsignedBigInteger('id_producto');
            $table->integer('cantidad_disponible');
            $table->decimal('precio_unitario', 10, 2);
            $table->text('descripcion')->nullable();
            $table->string('nombre_sucursal', 100);
            $table->string('direccion_sucursal', 100);
            $table->foreign('id_producto')->references('id_producto')->on('productos')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventarios');
    }
};