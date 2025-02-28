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
        Schema::create('oferta_educativa', function (Blueprint $table) {
            $table->engine = 'InnoDB'; 
            $table->id();
            $table->string('nombre_oferta');
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('oferta_educativa');
    }
};
