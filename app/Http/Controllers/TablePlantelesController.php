<?php

namespace App\Http\Controllers;

use App\Models\Plantel;
use Illuminate\Http\Request;

class TablePlantelesController extends Controller
{
    public function index()
    {
        $planteles = Plantel::with(['facturas', 'docentes'])->get();
        return view('tables.planteles', compact('planteles'));
    }

    public function create()
    {
        return view('planteles_view.planteles');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_plantel' => 'required|string|max:255',
        ]);

        Plantel::create($request->all());

        return redirect()->route('planteles.index')->with('success', 'Plantel registrado exitosamente.');
    }

    public function edit($id)
    {
        $plantel = Plantel::with(['facturas', 'docentes'])->findOrFail($id);
        return view('planteles_view.planteles', compact('plantel'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_plantel' => 'required|string|max:255',
        ]);

        $plantel = Plantel::findOrFail($id);
        $plantel->update($request->all());

        return redirect()->route('planteles.index')->with('success', 'Plantel actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $plantel = Plantel::findOrFail($id);

        $plantel->facturas()->detach();  
        $plantel->docentes()->detach();

        $plantel->delete(); 

        return redirect()->route('planteles.index')->with('success', 'Plantel eliminado exitosamente.');
    }

    // Eliminar múltiples planteles
    public function destroyMultiple(Request $request)
    {
        $request->validate([
            'planteles' => 'required|array',
            'planteles.*' => 'exists:planteles,id',
        ]);

        $planteles = Plantel::whereIn('id', $request->planteles)->get();

        foreach ($planteles as $plantel) {
            $plantel->facturas()->detach(); 
            $plantel->docentes()->detach(); 
            $plantel->delete(); 
        }

        return redirect()->route('planteles.index')->with('success', 'Planteles seleccionados eliminados exitosamente.');
    }
}
