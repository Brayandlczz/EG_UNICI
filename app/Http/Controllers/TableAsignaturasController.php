<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use App\Models\Docente;
use App\Models\OfertaEducativa;
use Illuminate\Http\Request;

class TableAsignaturasController extends Controller
{
    public function index()
    {
        $asignaturas = Asignatura::with(['ofertasEducativas', 'docente'])->get();
        return view('tables.asignaturas', compact('asignaturas'));
    }

    public function create()
    {
        $ofertasEducativas = OfertaEducativa::all();
        $docentes = Docente::all();
        return view('asignatura_view.asignatura', compact('ofertasEducativas', 'docentes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_asignatura' => 'required|string|max:255',
            'ofertas_educativas' => 'array',
            'ofertas_educativas.*' => 'exists:oferta_educativas,id', 
            'docentes' => 'array',
            'docentes.*' => 'exists:docentes,id', 
        ]);

        $asignatura = Asignatura::create($request->only('nombre_asignatura'));

        if ($request->has('ofertas_educativas')) {
            $asignatura->ofertasEducativas()->sync($request->ofertas_educativas);
        }

        if ($request->has('docentes')) {
            $asignatura->docente()->sync($request->docentes);
        }

        return redirect()->route('asignaturas.index')->with('success', 'Asignatura creada exitosamente.');
    }

    public function edit($id)
    {
        $asignatura = Asignatura::with(['ofertasEducativas', 'docente'])->findOrFail($id);
        $ofertasEducativas = OfertaEducativa::all();
        $docentes = Docente::all();

        return view('asignaturas.edit', compact('asignatura', 'ofertasEducativas', 'docentes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_asignatura' => 'required|string|max:255',
            'ofertas_educativas' => 'array',
            'ofertas_educativas.*' => 'exists:oferta_educativas,id',
            'docentes' => 'array',
            'docentes.*' => 'exists:docentes,id',
        ]);

        $asignatura = Asignatura::findOrFail($id);
        $asignatura->update($request->only('nombre_asignatura'));

        if ($request->has('ofertas_educativas')) {
            $asignatura->ofertasEducativas()->sync($request->ofertas_educativas);
        }

        if ($request->has('docentes')) {
            $asignatura->docente()->sync($request->docentes);
        }

        return redirect()->route('asignaturas.index')->with('success', 'Asignatura actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $asignatura = Asignatura::findOrFail($id);

        $asignatura->ofertasEducativas()->detach();
        $asignatura->docente()->detach();

        $asignatura->delete();

        return redirect()->route('asignaturas.index')->with('success', 'Asignatura eliminada exitosamente.');
    }

    public function destroyMultiple(Request $request)
    {
        $request->validate([
            'asignaturas' => 'required|array',
            'asignaturas.*' => 'exists:asignatura,id',
        ]);

        $asignaturas = Asignatura::whereIn('id', $request->asignaturas)->get();

        foreach ($asignaturas as $asignatura) {
            $asignatura->ofertasEducativas()->detach();
            $asignatura->docente()->detach();
            $asignatura->delete();
        }

        return redirect()->route('asignaturas.index')->with('success', 'Asignaturas seleccionadas eliminadas exitosamente.');
    }
}
