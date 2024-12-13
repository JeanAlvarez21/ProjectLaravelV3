<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultRolToUsersTable  extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Establecer un valor predeterminado para 'rol'
            $table->unsignedBigInteger('rol')->default(3)->change(); // El valor 3 corresponde al rol Cliente
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Eliminar el valor predeterminado
            $table->unsignedBigInteger('rol')->default(null)->change();
        });
    }
}
