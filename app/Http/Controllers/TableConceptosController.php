<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConceptoPago;

class TableConceptosController extends Controller
{
    public function index()
    {
        $conceptos = ConceptoPago::with('factura')->get(); 
        return view('tables.conceptos', compact('conceptos')); 
    }

    public function create()
    {
        return view('conceptos_view.conceptos'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'status' => 'required|in:Activo,Inactivo',  
        ]);

        ConceptoPago::create([
            'descripcion' => $request->descripcion,
            'status' => $request->status, 
        ]);

        return redirect()->route('conceptos.index')->with('success', 'Concepto de pago agregado correctamente.');
    }

    public function edit($id)
    {
        $concepto = ConceptoPago::with('factura')->findOrFail($id);
        return view('conceptos_view.conceptos', compact('concepto'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'status' => 'required|in:Activo,Inactivo',  
        ]);

        $concepto = ConceptoPago::findOrFail($id);
        $concepto->update([
            'descripcion' => $request->descripcion,
            'status' => $request->status,  
        ]);

        return redirect()->route('conceptos.index')->with('success', 'Concepto de pago actualizado correctamente.');
    }

    public function destroy($id)
    {
        $concepto = ConceptoPago::find($id);
        if (!$concepto) {
            return redirect()->route('conceptos.index')->with('error', 'Concepto no encontrado.');
        }

        $concepto->factura()->delete(); 

        $concepto->delete();
        return redirect()->route('conceptos.index')->with('success', 'Concepto de pago eliminado correctamente.');
    }

    public function destroyMultiple(Request $request)
    {
        $request->validate([
            'conceptos' => 'required|array',
            'conceptos.*' => 'exists:conceptos_pago,id',
        ]);

        $conceptos = ConceptoPago::whereIn('id', $request->conceptos)->get();

        foreach ($conceptos as $concepto) {
            $concepto->factura()->delete();
            $concepto->delete();
        }

        return redirect()->route('conceptos.index')->with('success', 'Conceptos eliminados correctamente.');
    }
}
