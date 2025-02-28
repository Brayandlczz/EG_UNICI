<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('docente', function (Blueprint $table) {
            $table->engine = 'InnoDB'; 
            $table->id();
            $table->string('nombre_docente')-> unique();
            $table->foreignId('oferta_educativa_id')->constrained('oferta_educativa')->cascadeOnDelete();
            $table->foreignId('periodo_pago_id')->constrained('periodo_pago')->cascadeOnDelete();
            $table->decimal('importe_pago', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('docente');
    }
};
