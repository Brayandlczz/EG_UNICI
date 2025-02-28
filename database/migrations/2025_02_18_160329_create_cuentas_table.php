<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('cuenta_banco', function (Blueprint $table) {
            $table->engine = 'InnoDB'; 
            $table->id();
            $table->string('banco');
            $table->string('numero_cuenta')->unique();
            $table->string('razon_social');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('cuenta_banco');
    }
};
