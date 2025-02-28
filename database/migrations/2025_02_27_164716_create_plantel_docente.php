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
        Schema::create('plantel_docente', function (Blueprint $table) {
            $table->engine = 'InnoDB'; 
            $table->id();
            $table->foreignId('plantel_id')->constrained('plantel')->cascadeOnDelete();
            $table->foreignId('docente_id')->constrained('docente')->cascadeOnDelete();
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('plantel_docente');
    }
};
