<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodoPago extends Model
{
    use HasFactory;

    protected $table = 'periodo_pago';

    protected $fillable = [
        'inicio_periodo',
        'fin_periodo',
        'tipo_periodo',
        'concatenado',  
    ];

    public function factura() 
    {
        return $this->hasMany(Factura::class, 'periodo_pago_id');
    }
}
