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
        Schema::create('estado_pedido', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
        });

        // Insertar los valores predefinidos
        DB::table('estado_pedido')->insert([
            ['id' => 1, 'nombre' => 'Pendiente'],
            ['id' => 2, 'nombre' => 'En proceso'],
            ['id' => 3, 'nombre' => 'En Reparto'],
            ['id' => 4, 'nombre' => 'Recibido'],
            ['id' => 5, 'nombre' => 'Cancelado'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estado_pedido');
    }
};
