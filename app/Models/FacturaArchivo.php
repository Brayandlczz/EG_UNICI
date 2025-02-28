<?php

// FacturaArchivo.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaArchivo extends Model
{
    protected $table = 'facturas_archivos'; 
    protected $fillable = [
        'path', 
        'tipo_archivo_id',
        'grupo_archivos_id'
    ];

    public function tipoArchivo()
    {
        return $this->belongsTo(TipoArchivo::class);  
    }

    public function grupoArchivo()
    {
        return $this->belongsTo(GrupoArchivo::class);  
    }

    public function factura()
    {
        return $this->belongsTo(Factura::class); 
    }
}
