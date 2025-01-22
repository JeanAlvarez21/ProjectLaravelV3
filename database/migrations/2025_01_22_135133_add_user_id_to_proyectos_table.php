<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('proyectos', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id')->nullable(); // Campo para relacionar con usuarios
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Relación con la tabla users
        });
    }

    public function down(): void
    {
        Schema::table('proyectos', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
