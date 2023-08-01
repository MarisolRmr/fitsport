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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('correo')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->datetime('fecha_nac');
            $table->string('telefono')->nullable();
            $table->string('genero')->nullable();
            $table->string('usuario')->nullable()->unique();
            $table->string('password')->nullable();
            $table->string('fotografia')->nullable();
            $table->string('latitud')->nullable();
            $table->string('longitud')->nullable();
            $table->string('horario')->nullable();
            $table->string('direccion')->nullable();
            $table->string('cedula')->nullable()->unique();
            //agregamos el usuario asociado al tipo de usuario
            $table->foreignId('tipo_id')->constrained('tipo_usuarios')->onDelete('cascade');

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
