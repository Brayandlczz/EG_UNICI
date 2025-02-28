<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $table = 'factura';

    protected $fillable = [
        'folio',
        'fecha_pago',
        'mes_pago',
        'importe',
        'forma_pago',
        'plantel_id',
        'docente_id',
        'banco_id',
        'concepto_pago_id',
        'periodo_pago_id',
        'usuario_id',
    ];

    public function plantel()
    {
        return $this->belongsTo(Plantel::class);
    }

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }

    public function banco()
    {
        return $this->belongsTo(CuentasBanco::class, 'banco_id');
    }

    public function conceptoPago()
    {
        return $this->belongsTo(ConceptoPago::class, 'concepto_pago_id');
    }

    public function periodoPago()
    {
        return $this->belongsTo(PeriodoPago::class, 'periodo_pago_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function archivos()
    {
        return $this->hasMany(FacturaArchivo::class, 'facturas_id');
    }
}
