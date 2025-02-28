<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('factura', function (Blueprint $table) {
            $table->engine = 'InnoDB'; 
            $table->id();
            $table->string('folio')->unique();
            $table->date('fecha_pago');
            $table->date('mes_pago');
            $table->decimal('importe', 10, 2);
            $table->string('forma_pago')->nullable(); 
            $table->foreignId('plantel_id')->constrained('plantel')->cascadeOnDelete();  
            $table->foreignId('docente_id')->constrained('docente')->cascadeOnDelete();
            $table->foreignId('banco_id')->constrained('cuenta_banco')->cascadeOnDelete();
            $table->foreignId('concepto_pago_id')->constrained('concepto_pago')->cascadeOnDelete();  
            $table->foreignId('periodo_pago_id')->constrained('periodo_pago')->cascadeOnDelete(); 
            $table->foreignId('usuario_id')->constrained('users')->cascadeOnDelete(); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('factura');
    }
};
