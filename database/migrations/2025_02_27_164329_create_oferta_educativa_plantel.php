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
        Schema::create('oferta_educativa_plantel', function (Blueprint $table) {
            $table->engine = 'InnoDB'; 
            $table->id();
            $table->foreignId('plantel_id')->constrained('plantel')->cascadeOnDelete();
            $table->foreignId('oferta_educativa_id')->constrained('oferta_educativa')->cascadeOnDelete();
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('oferta_educativa_plantel');
    }
};
