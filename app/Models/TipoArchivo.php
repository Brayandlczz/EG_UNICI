<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoArchivo extends Model
{
    protected $table = 'tipo_archivo'; 
    protected $fillable = [
        'extension', 
    ];

    public function facturas()
    {
        return $this->hasMany(FacturaArchivo::class, 'tipo_archivo_id');
    }
}

