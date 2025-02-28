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
        Schema::create('facturas_archivos', function (Blueprint $table) {
            $table->engine = 'InnoDB'; 
            $table->id();
            $table->string('path')->unique();
            $table->foreignId('facturas_id')->constrained('factura')->cascadeOnDelete();
            $table->foreignId('tipo_archivo_id')->constrained('tipo_archivo')->cascadeOnDelete();
            $table->foreignId('grupo_archivos_id')->constrained('grupo_archivos')->cascadeOnDelete();            
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('facturas_archivos');
    }
};
