<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docente;
use App\Models\Plantel;
use App\Models\PeriodoPago;
use App\Models\OfertaEducativa;
use Illuminate\Support\Facades\DB;

DB::listen(function ($query) {
    \Log::info($query->sql);
    \Log::info($query->bindings);
});

class TableDocentesController extends Controller
{
    public function index()
    {
        $docentes = Docente::with(['planteles', 'ofertaEducativa'])->get();  
        return view('tables.docentes', compact('docentes'));
    }

    public function create()
    {
        $ofertas = OfertaEducativa::all();
        $periodos_pago = PeriodoPago::all(); 
        $planteles = Plantel::all();

        //dd($ofertas, $periodos_pago, $planteles);
        
        return view('docentes_view.docentes', compact('ofertas', 'periodos_pago', 'planteles'));
    }

    public function store(Request $request)
    {
        //dd($request->all()); 
        $request->validate([
            'nombre_docente' => 'required|string|max:255',
            'asignatura' => 'required|string|max:255',
            'oferta_educativa_id' => 'required|integer|exists:oferta_educativa,id',
            'periodo_pago_id' => 'required|integer|exists:periodos_pago,id',
            'importe_pago' => 'required|numeric|min:0',
            'planteles' => 'required|array',
            'planteles.*' => 'exists:planteles,id',
            
        ]);
        
        $docente = Docente::create([
            'nombre_docente' => $request->nombre_docente,
            'asignatura' => $request->asignatura,
            'oferta_educativa_id' => $request->oferta_educativa_id, 
            'periodos_pago_id' => $request->periodos_pago_id, 
            'importe_pago' => $request->importe_pago,
        ]);

        $docente->planteles()->sync($request->planteles);

        return redirect()->route('docentes.index')->with('success', 'Docente agregado correctamente.');
    }

    public function edit($id)
    {
        $docente = Docente::with(['planteles', 'ofertaEducativa'])->findOrFail($id);  
        $ofertas = OfertaEducativa::all(); 
        $periodos_pago = PeriodoPago::all(); 
        $planteles = Plantel::all();
        
        return view('docentes_view.docentes', compact('docente', 'ofertas', 'periodos_pago', 'planteles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_docente' => 'required|string|max:255',
            'asignatura' => 'required|string|max:255',
            'oferta_educativa_id' => 'required|integer|exists:oferta_educativa,id', 
            'periodos_pago_id' => 'required|integer|exists:periodos_pago,id', 
            'importe_pago' => 'required|numeric|min:0',
            'planteles' => 'required|array',
            'planteles.*' => 'exists:planteles,id',
        ]);

        $docente = Docente::findOrFail($id);
        $docente->update([
            'nombre_docente' => $request->nombre_docente,
            'asignatura' => $request->asignatura,
            'oferta_educativa_id' => $request->oferta_educativa_id, 
            'periodos_pago_id' => $request->periodos_pago_id, 
            'importe_pago' => $request->importe_pago,
        ]);

        $docente->planteles()->sync($request->planteles);

        return redirect()->route('docentes.index')->with('success', 'Docente actualizado correctamente.');
    }

    public function destroy($id)
    {
        $docente = Docente::find($id);
        if (!$docente) {
            return redirect()->route('docentes.index')->with('error', 'Docente no encontrado.');
        }

        $docente->planteles()->detach();
        $docente->delete();

        return redirect()->route('docentes.index')->with('success', 'Docente eliminado correctamente.');
    }

    public function destroyMultiple(Request $request)
    {
        $request->validate([
            'docentes' => 'required|array',
            'docentes.*' => 'exists:docentes,id',
        ]);

        $docentes = Docente::find($request->docentes);
        foreach ($docentes as $docente) {
            $docente->planteles()->detach(); 
            $docente->delete();
        }

        return redirect()->route('docentes.index')->with('success', 'Docentes eliminados correctamente.');
    }

    public function getDocentes(Request $request)
    {
        $query = $request->input('query');
        $docentes = Docente::where('nombre_docente', 'LIKE', "%{$query}%")
                           ->get(['nombre_docente']);
        
        return response()->json($docentes);
    }
}
