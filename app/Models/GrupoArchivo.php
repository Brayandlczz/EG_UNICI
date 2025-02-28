<?php

// GrupoArchivo.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoArchivo extends Model
{
    protected $table = 'grupo_archivos'; 
    protected $fillable = [
        'tipo', 
    ];

    public function facturas()
    {
        return $this->hasMany(FacturaArchivo::class, 'grupo_archivos_id');
    }
}
