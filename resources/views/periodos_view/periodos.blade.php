@extends('layouts.app')

@section('title', isset($periodo) ? 'Editar Periodo de Pago' : 'Agregar Periodo de Pago')

@section('content')
<div class="container">
    <h2 class="mt-4">
        Periodos de Pago <span class="text-muted">{{ isset($periodo) ? 'Edición' : 'Registro' }}</span>
    </h2>

    <div class="card mt-3">
        <div class="card-header bg-primary text-white">Datos del Periodo de Pago</div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ isset($periodo) ? route('periodos.update', $periodo->id) : route('periodos.store') }}" method="POST">
                @csrf
                @if(isset($periodo))
                    @method('PUT') 
                @endif

                <div class="mb-3">
                    <label class="form-label" for="inicio_periodo">Seleccione el inicio del periodo</label>
                    <input 
                        type="date" 
                        name="inicio_periodo" 
                        id="inicio_periodo" 
                        class="form-control @error('inicio_periodo') is-invalid @enderror" 
                        value="{{ isset($periodo) ? $periodo->inicio_periodo : old('inicio_periodo') }}" 
                        required>
                    @error('inicio_periodo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="fin_periodo">Seleccione el fin del periodo</label>
                    <input 
                        type="date" 
                        name="fin_periodo" 
                        id="fin_periodo" 
                        class="form-control @error('fin_periodo') is-invalid @enderror" 
                        value="{{ isset($periodo) ? $periodo->fin_periodo : old('fin_periodo') }}" 
                        required>
                    @error('fin_periodo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="tipo_periodo">Tipo de periodo</label>
                    <input 
                        type="text" 
                        name="tipo_periodo" 
                        id="tipo_periodo" 
                        class="form-control @error('tipo_periodo') is-invalid @enderror" 
                        value="{{ isset($periodo) ? $periodo->tipo_periodo : old('tipo_periodo') }}" 
                        required>
                    @error('tipo_periodo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <a href="{{ route('periodos.index') }}" class="btn btn-danger">Cancelar</a>
                    <button type="submit" class="btn btn-primary">{{ isset($periodo) ? 'Actualizar Periodo' : 'Guardar Periodo' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
