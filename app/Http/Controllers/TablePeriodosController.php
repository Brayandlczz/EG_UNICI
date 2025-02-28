<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeriodoPago;
use App\Models\Factura;
use Carbon\Carbon;

class TablePeriodosController extends Controller
{
    public function index()
    {
        $periodos = PeriodoPago::with('factura')->get(); 
        return view('tables.periodos', compact('periodos'));
    }

    public function create()
    {
        return view('periodos_view.periodos'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'inicio_periodo' => 'required|date',
            'fin_periodo' => 'required|date|after_or_equal:inicio_periodo',
        ]);

        $tipo_periodo = $this->calcularTipoPeriodo($request->inicio_periodo, $request->fin_periodo);
        $periodo = $this->calcularPeriodo($request->inicio_periodo, $request->fin_periodo);

        $concatenado = $this->calcularConcatenado($request->inicio_periodo, $request->fin_periodo);

        $periodoPago = PeriodoPago::create([
            'inicio_periodo' => $request->inicio_periodo,
            'fin_periodo' => $request->fin_periodo,
            'tipo_periodo' => $tipo_periodo,
            'concatenado' => $concatenado, 
        ]);

        return redirect()->route('periodos.index')->with('success', 'Periodo de pago creado exitosamente');
    }

    public function edit($id)
    {
        $periodo = PeriodoPago::findOrFail($id);
        return view('periodos_view.periodos', compact('periodo')); 
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'inicio_periodo' => 'required|date',
            'fin_periodo' => 'required|date|after_or_equal:inicio_periodo',
        ]);

        $tipo_periodo = $this->calcularTipoPeriodo($request->inicio_periodo, $request->fin_periodo);
        $periodo = $this->calcularPeriodo($request->inicio_periodo, $request->fin_periodo);

        $concatenado = $this->calcularConcatenado($request->inicio_periodo, $request->fin_periodo);

        $periodoPago = PeriodoPago::findOrFail($id);
        $periodoPago->update([
            'inicio_periodo' => $request->inicio_periodo,
            'fin_periodo' => $request->fin_periodo,
            'tipo_periodo' => $tipo_periodo,
            'concatenado' => $concatenado, 
        ]);

        return redirect()->route('periodos.index')->with('success', 'Periodo de pago actualizado exitosamente');
    }

    private function calcularTipoPeriodo($inicio, $fin)
    {
        $inicioCarbon = Carbon::parse($inicio);
        $finCarbon = Carbon::parse($fin);
        
        $diffInMonths = $inicioCarbon->diffInMonths($finCarbon);
        $diffInDays = $inicioCarbon->diffInDays($finCarbon);
        
        if ($diffInMonths == 1 && $diffInDays <= 31) {
            return 'Mensual'; 
        } elseif ($diffInMonths == 2) {
            return 'Bimensual'; 
        } elseif ($diffInMonths == 3) {
            return 'Trimestral';
        } elseif ($diffInMonths <= 6) {
            return 'Semestral'; 
        } elseif ($diffInMonths <= 12) {
            return 'Anual'; 
        } else {
            return 'Periodo largo'; 
        }
    }

    private function calcularPeriodo($inicio, $fin)
    {
        $inicioCarbon = Carbon::parse($inicio);
        $finCarbon = Carbon::parse($fin);
        
        $inicioMes = $inicioCarbon->locale('es')->translatedFormat('F');
        $finMes = $finCarbon->locale('es')->translatedFormat('F Y');

        return ($inicioMes === explode(" ", $finMes)[0]) ? $finMes : "$inicioMes - $finMes";
    }

    private function calcularConcatenado($inicio, $fin)
    {
        $inicioCarbon = Carbon::parse($inicio);
        $finCarbon = Carbon::parse($fin);
    
        Carbon::setLocale('es'); 
        
        return "{$inicioCarbon->translatedFormat('F Y')} - {$finCarbon->translatedFormat('F Y')}";
    }    

    public function destroy($id)
    {
        $periodo = PeriodoPago::findOrFail($id);
        $periodo->facturas()->delete(); 
        $periodo->delete();

        return redirect()->route('periodos.index')->with('success', 'Periodo eliminado exitosamente');
    }

    public function destroyMultiple(Request $request)
    {
        $ids = $request->input('periodos');
        $periodos = PeriodoPago::whereIn('id', $ids)->get();

        foreach ($periodos as $periodo) {
            $periodo->facturas()->delete(); 
            $periodo->delete();
        }

        return redirect()->route('periodos.index')->with('success', 'Periodos seleccionados eliminados exitosamente');
    }
}
