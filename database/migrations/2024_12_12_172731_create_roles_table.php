<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id('id_rol'); // Este campo es autoincrementable
            $table->string('nombre_rol')->unique(); // El nombre del rol será único
            $table->timestamps(); // Campos para crear y actualizar las fechas
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }

};
