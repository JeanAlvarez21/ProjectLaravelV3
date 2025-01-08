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
            $table->id('id_producto'); // Clave primaria
            $table->string('nombre_producto', 100);
            $table->string('descripcion', 100);
            $table->integer('cantidad');
            $table->string('unidad_medida', 50);
            $table->string('link_imagen', 255);
            $table->unsignedBigInteger('id_categoria'); // Tipo consistente con la tabla 'categorias'
            $table->boolean('visible')->default(true); // Nuevo campo para visibilidad
            $table->foreign('id_categoria')->references('id_categoria')->on('categorias')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
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