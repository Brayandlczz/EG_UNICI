<?php
//NO HACER CASO, AÚN SIN FUNCIONALIDAD
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class ArchiveController extends Controller
{
    public function mostrarPdf($id)
    {
        $factura = DB::table('factura')->where('id', $id)->first();
        
        if (!$factura) {
            return abort(404);
        }

        $pdf = $factura->factura_pdf;

        return response($pdf, 200)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'inline; filename="factura.pdf"');
    }
}
