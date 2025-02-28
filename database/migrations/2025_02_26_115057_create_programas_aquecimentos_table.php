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
        Schema::create('programas_aquecimentos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('alimento');
            $table->string('tempo');
            $table->integer('potencia');
            $table->string('instrucoes')->nullable()->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programas_aquecimentos');
    }
};
