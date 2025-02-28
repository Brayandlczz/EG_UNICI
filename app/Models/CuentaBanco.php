<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentaBanco extends Model
{
    use HasFactory;

    protected $table = 'cuenta_banco'; 

    protected $fillable = [
        'banco',
        'numero_cuenta',
        'razon_social',
    ];

    public function facturas()
    {
        return $this->hasMany(Factura::class, 'banco_id');
    }
}
