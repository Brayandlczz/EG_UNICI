<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('periodo_pago', function (Blueprint $table) {
            $table->engine = 'InnoDB'; 
            $table->id();
            $table->date('inicio_periodo');
            $table->date('fin_periodo');
            $table->string('tipo_periodo');
            $table->string('concatenado');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('periodo_pago');
    }
};
