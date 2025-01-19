
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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->bigIncrements('id_pedido'); // Clave primaria
            $table->foreignId('id_usuario')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->dateTime('fecha_pedido');
            $table->string('direccion_pedido');
            $table->decimal('total', 10, 2);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
