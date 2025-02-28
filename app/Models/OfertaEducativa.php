<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfertaEducativa extends Model
{
    use HasFactory;

    protected $table = 'oferta_educativa';
    protected $fillable = [
        'nombre_oferta',
    ];

    public function asignaturas()
    {
        return $this->belongsToMany(Asignatura::class, 'oferta_educativa_asignatura');
    }

    public function planteles()
    {
        return $this->belongsToMany(Plantel::class, 'oferta_educativa_plantel');
    }

    public function docentes()
    {
        return $this->hasMany(Docente::class, 'oferta_educativa_id');
    }
}
