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
        Schema::create('grupo_archivos', function (Blueprint $table) {
            $table->engine = 'InnoDB'; 
            $table->id();
            $table->string('tipo');
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('grupo_archivos');
    }
};
