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
            $table->unsignedBigInteger('producto_id'); // Referencia al producto
            $table->unsignedBigInteger('cliente_id')->nullable(); // Referencia al usuario (rol cliente) en users
            $table->string('medidas', 255); // Dimensiones del corte
            $table->integer('cantidad'); // Cantidad de cortes realizados
            $table->decimal('precio_total', 10, 2); // Precio total del corte
            $table->string('bordes');
            $table->string('descripcion_corte');
            $table->timestamp('fecha_corte'); // Fecha del corte
            $table->timestamps(); // Campos created_at y updated_at

            // Relaciones
            $table->foreign('producto_id')->references('id')->on('productos')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('cliente_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
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
