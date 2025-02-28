<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('concepto_pago', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('descripcion');
            $table->enum('status', ['activo', 'inactivo'])->default('activo'); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('concepto_pago');
    }
};
