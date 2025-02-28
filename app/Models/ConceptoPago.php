<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConceptoPago extends Model
{
    use HasFactory;

    protected $table = 'concepto_pago'; 

    protected $fillable = [
        'descripcion',
        'status',
    ];

    public function factura()
    {
        return $this->hasMany(Factura::class);
    }
}
