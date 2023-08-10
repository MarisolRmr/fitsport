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
        //
        Schema::table('gimnasios', function (Blueprint $table) {
            //Agregar capo a tabla de usuarios 
            //$table -> string('username');

            //Agregar capo a tabla de usuarios Unico
            $table -> string('horarioCierre');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
