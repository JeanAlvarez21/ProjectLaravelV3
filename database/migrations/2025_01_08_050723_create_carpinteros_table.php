<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarpinterosTable extends Migration
{
    public function up()
    {
        Schema::create('carpinteros', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('especialidad');
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('ubicacion')->nullable();
            $table->text('descripcion')->nullable();
            $table->boolean('disponibilidad')->default(true);
            $table->string('foto_perfil')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('carpinteros');
    }
}

