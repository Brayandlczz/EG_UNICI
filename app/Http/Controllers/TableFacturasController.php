<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\PeriodoPago;  
use App\Models\ConceptoPago; 
use App\Models\CuentaBanco;
use App\Models\Docente;  
use Illuminate\Http\Request;

class TableFacturasController extends Controller
{
    public function index(Request $request)
    {
        $orden = $request->query('orden', 'asc');
        $facturas = Factura::orderBy('fecha_pago', $orden)->get();

        return view('tables.facturas', compact('factura', 'orden')); 
    }

    public function create()
    {
        $periodos = PeriodoPago::all();         
        $conceptos = ConceptoPago::all();
        $docentes = Docente::all(); 
        $bancos = CuentaBanco::all();      

        return view('facturas_view.formfacturas', compact('periodos', 'conceptos', 'docentes', 'bancos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plantel' => 'required|string',
            'folio' => 'nullable|string',
            'docente' => 'nullable|string',
            'fecha_pago' => 'nullable|date',
            'periodo_pago' => 'nullable|string',
            'mes_pago' => 'nullable|date',
            'concepto_pago' => 'nullable|string',
            'banco' => 'nullable|string',
            'importe' => 'nullable|numeric',
            'forma_pago' => 'nullable|string',
            'factura_pdf' => 'nullable|file|mimes:pdf',
            'factura_xml' => 'nullable|file|mimes:xml',
            'comprobante' => 'nullable|file|mimes:pdf',
        ]);

        $facturaPath = $request->file('factura_pdf') ? $request->file('factura_pdf')->store('facturas', 'public') : null;
        $xmlPath = $request->file('factura_xml') ? $request->file('factura_xml')->store('xmls', 'public') : null;
        $comprobantePath = $request->file('comprobante') ? $request->file('comprobante')->store('comprobantes', 'public') : null;

        Factura::create([
            'plantel_id' => $request->input('plantel'),
            'folio' => $request->input('folio'),
            'docente_id' => $request->input('docente'),
            'fecha_pago' => $request->input('fecha_pago'),
            'periodo_pago_id' => $request->input('periodo_pago'),
            'mes_pago' => $request->input('mes_pago'),
            'concepto_pago_id' => $request->input('concepto_pago'),
            'banco_id' => $request->input('banco'),
            'importe' => $request->input('importe'),
            'forma_pago' => $request->input('forma_pago'),
            'factura_pdf' => $facturaPath,
            'factura_xml' => $xmlPath,
            'comprobante' => $comprobantePath,
        ]);

        return redirect()->route('facturas.create')->with('success', 'Factura procesada correctamente.');
    }

    public function edit($id)
    {
        $factura = Factura::findOrFail($id); 
        return view('facturas.edit', compact('factura'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'plantel' => 'required|string|max:255',
            'folio' => 'required|string|max:255',
            'docente' => 'required|string|max:255',
            'fecha_pago' => 'required|date',
            'importe' => 'required|numeric',
            'forma_pago' => 'required|string|max:255',
            'factura_pdf' => 'nullable|file|mimes:pdf',
            'factura_xml' => 'nullable|file|mimes:xml',
            'comprobante_pago' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        $factura = Factura::findOrFail($id); 
        $factura->update($request->all()); 

        if ($request->hasFile('factura_pdf')) {
            $factura->factura_pdf = $request->file('factura_pdf')->store('facturas', 'public');
        }
        if ($request->hasFile('factura_xml')) {
            $factura->factura_xml = $request->file('factura_xml')->store('xmls', 'public');
        }
        if ($request->hasFile('comprobante_pago')) {
            $factura->comprobante = $request->file('comprobante_pago')->store('comprobantes', 'public');
        }

        $factura->save(); 

        return redirect()->route('facturas.index')->with('success', 'Factura actualizada correctamente.');
    }

    public function destroy($id)
    {
        $factura = Factura::findOrFail($id); 
        $factura->delete(); 
        return redirect()->route('facturas.index')->with('success', 'Factura eliminada correctamente.');
    }

    public function destroyMultiple(Request $request)
    {
        $ids = $request->input('facturas');
        if (!empty($ids)) {
            Factura::whereIn('id', $ids)->delete(); 
            return redirect()->route('facturas.index')->with('success', 'Facturas seleccionadas eliminadas correctamente.');
        }
        return redirect()->route('facturas.index')->with('error', 'No se seleccionaron facturas para eliminar.');
    }
}
