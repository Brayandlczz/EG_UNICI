<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CuentaBanco;

class TableCuentasController extends Controller
{
    public function index()
    {
        $cuentas = CuentaBanco::all();
        return view('tables.cuentas', compact('cuentas')); 
    }

    public function create()
    {
        return view('cuentas_view.cuentas');
    }

    public function store(Request $request)
    {
        $request->validate([
            'banco' => 'required|string|max:255', 
            'numero_cuenta' => 'required|string|max:50|unique:cuenta_banco,numero_cuenta', 
            'razon_social' => 'required|string|max:255', 
        ]);

        CuentaBanco::create($request->only(['banco', 'numero_cuenta', 'razon_social']));

        return redirect()->route('bancos.index')->with('success', 'Cuenta bancaria creada con éxito.');
    }

    public function edit($id)
    {
        $banco = CuentaBanco::findOrFail($id); 
        return view('cuentas_view.cuentas', compact('banco')); 
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'banco' => 'required|string|max:255', 
            'numero_cuenta' => "required|string|max:50|unique:cuenta_banco,numero_cuenta,{$id}",
            'razon_social' => 'required|string|max:255',
        ]);

        $banco = CuentaBanco::findOrFail($id); 
        $banco->update([
            'banco' => $request->banco,  
            'numero_cuenta' => $request->numero_cuenta,
            'razon_social' => $request->razon_social
        ]);

        return redirect()->route('bancos.index')->with('success', 'Cuenta bancaria actualizada correctamente.');
    }

    public function destroy($id)
    {
        $banco = CuentaBanco::findOrFail($id); 
        $banco->delete();
        return redirect()->route('bancos.index')->with('success', 'Cuenta bancaria eliminada con éxito.');
    }

    public function destroyMultiple(Request $request)
    {
        $request->validate([
            'cuentas' => 'required|array|min:1', 
            'cuentas.*' => 'exists:cuenta_banco,id',
        ]);

        CuentaBanco::whereIn('id', $request->cuentas)->delete();

        return redirect()->route('bancos.index')->with('success', 'Cuentas bancarias eliminadas con éxito.');
    }

    public function getBancos()
    {
        $bancos = CuentaBanco::select('banco')->distinct()->get();
        return response()->json($bancos); 
    }
}
