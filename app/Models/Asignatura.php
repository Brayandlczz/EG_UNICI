<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    use HasFactory;

    protected $table = 'asignatura';
    protected $fillable = [
        'nombre_asignatura',
    ];

    public function ofertasEducativas()
    {
        return $this->belongsToMany(OfertaEducativa::class, 'oferta_educativa_asignatura');
    }

    public function docente()
    {
        return $this->belongsToMany(Docente::class, 'asignatura_docente');
    }
}
