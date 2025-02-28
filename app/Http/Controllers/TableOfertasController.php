<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OfertaEducativa;
use App\Models\Plantel;

class TableOfertasController extends Controller
{
    public function index()
    {
        $ofertas = OfertaEducativa::with('planteles')->get();

        return view('tables.ofertas', compact('ofertas'));
    }

    public function create()
    {
        $planteles = Plantel::all();

        return view('ofertas_view.ofertas', compact('planteles'));  
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_oferta' => 'required|string|max:255',
            'planteles' => 'nullable|array',  
            'planteles.*' => 'exists:planteles,id', 
        ]);
    
        $oferta = OfertaEducativa::create([
            'nombre_oferta' => $request->nombre_oferta,
        ]);
    
        if ($request->has('planteles')) {
            $oferta->planteles()->attach($request->planteles);
        }
    
        return redirect()->route('ofertas.index')->with('success', 'Oferta educativa agregada correctamente.');
    }
    
    public function edit($id)
    {
        $oferta = OfertaEducativa::with('planteles')->findOrFail($id);
        $planteles = Plantel::all(); // Obtener todos los planteles

        return view('ofertas_view.ofertas', compact('oferta', 'planteles'));  
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_oferta' => 'required|string|max:255',
            'planteles' => 'nullable|array',
            'planteles.*' => 'exists:planteles,id', 
        ]);

        $oferta = OfertaEducativa::findOrFail($id);

        $oferta->update([
            'nombre_oferta' => $request->nombre_oferta,
        ]);

        if ($request->has('planteles')) {
            $oferta->planteles()->sync($request->planteles);
        }

        return redirect()->route('ofertas.index')->with('success', 'Oferta educativa actualizada correctamente.');
    }

    public function destroy($id)
    {
        $oferta = OfertaEducativa::findOrFail($id);

        $oferta->planteles()->detach();

        $oferta->delete();

        return redirect()->route('ofertas.index')->with('success', 'Oferta educativa eliminada correctamente.');
    }

    public function destroyMultiple(Request $request)
    {
        $request->validate([
            'ofertas' => 'required|array',
            'ofertas.*' => 'exists:oferta_educativa,id',
        ]);

        $ofertas = OfertaEducativa::whereIn('id', $request->ofertas)->get();

        foreach ($ofertas as $oferta) {
            $oferta->planteles()->detach();

            $oferta->delete();
        }

        return redirect()->route('ofertas.index')->with('success', 'Ofertas educativas eliminadas correctamente.');
    }
}
