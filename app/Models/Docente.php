<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;

    protected $table = 'docente';

    protected $fillable = [
        'nombre_docente',
        'oferta_educativa_id',
        'periodos_pago_id',
        'importe_pago',
    ];

    public function ofertaEducativa()
    {
        return $this->belongsTo(OfertaEducativa::class, 'oferta_educativa_id');
    }

    public function asignaturas()
    {
        return $this->belongsToMany(Asignatura::class, 'asignatura_docente');
    }
    
    public function periodoPago()
    {
        return $this->belongsTo(PeriodoPago::class, 'periodo_pago_id');
    }

    public function plantel()
    {
        return $this->belongsToMany(Plantel::class, 'plantel_docente', 'plantel_id', 'docente_id');
    }

    public function factura()
    {
        return $this->hasMany(Factura::class, 'docente_id');
    }
}
