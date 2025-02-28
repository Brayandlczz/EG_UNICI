<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plantel extends Model
{
    use HasFactory;

    protected $table = 'plantel'; 

    protected $fillable = [
        'nombre_plantel',
    ];

    public function ofertasEducativas()
    {
        return $this->belongsToMany(OfertaEducativa::class, 'oferta_educativa_plantel');
    }

    public function facturas()
    {
        return $this->hasMany(Factura::class);
    }

    public function docentes()
    {
        return $this->belongsToMany(Docente::class, 'plantel_docente', 'plantel_id', 'docente_id');
    }
}
