<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Importar la clase DB para realizar inserciones

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id('rol'); // Este campo es autoincrementable
            $table->string('nombre_rol')->unique(); // El nombre del rol será único
            $table->timestamps(); // Campos para crear y actualizar las fechas
        });

        // Insertar los valores predeterminados
        DB::table('roles')->insert([
            ['rol' => 1, 'nombre_rol' => 'Admin', 'created_at' => now(), 'updated_at' => now()],
            ['rol' => 2, 'nombre_rol' => 'Empleado', 'created_at' => now(), 'updated_at' => now()],
            ['rol' => 3, 'nombre_rol' => 'Cliente', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
