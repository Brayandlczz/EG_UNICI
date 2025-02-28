@extends('layouts.app')

@section('title', isset($docente) ? 'Editar Docente' : 'Registrar Docente')

@section('content')
<div class="container">
    <h2 class="mt-4">Docentes <span class="text-muted">{{ isset($docente) ? 'Edición' : 'Registro' }}</span></h2>

    <div class="card mt-3">
        <div class="card-header bg-primary text-white">{{ isset($docente) ? 'Editar Datos del Docente' : 'Datos del Docente' }}</div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ isset($docente) ? route('docentes.update', $docente->id) : route('docentes.store') }}" method="POST">
                @csrf
                @if(isset($docente))
                    @method('PUT')
                @endif

    <div class="col-md-3">
        <div class="mb-3">
                <label for="planteles" class="form-label">Planteles</label>
                    <select name="planteles" id="planteles" class="form-select form-select-sm @error('planteles') is-invalid @enderror" required>
                        <option value="">Seleccionar plantel</option>
                        @foreach($planteles as $plantel)
                            <option value="{{ $plantel->id }}" {{ old('planteles', isset($docente) ? $docente->planteles->pluck('id')->first() : '') == $plantel->id ? 'selected' : '' }}>
                                    {{ $plantel->nombre_plantel }}
                            </option>
                        @endforeach
                        </select>
                        @error('planteles')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="nombre_docente" class="form-label">Nombre del Docente</label>
                        <input type="text" class="form-control @error('nombre_docente') is-invalid @enderror"
                               name="nombre_docente" id="nombre_docente"
                               value="{{ old('nombre_docente', $docente->nombre_docente ?? '') }}" required>
                        @error('nombre_docente')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="asignatura" class="form-label">Asignatura</label>
                        <input type="text" class="form-control @error('asignatura') is-invalid @enderror"
                               name="asignatura" id="asignatura"
                               value="{{ old('asignatura', $docente->asignatura ?? '') }}" required>
                        @error('asignatura')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="oferta_educativa_id" class="form-label">Oferta Educativa</label>
                        <select name="oferta_educativa_id" id="oferta_educativa_id" class="form-select @error('oferta_educativa_id') is-invalid @enderror" required>
                            <option value="">Seleccionar oferta educativa</option>
                            @foreach($ofertas as $oferta)
                                <option value="{{ $oferta->id }}" {{ old('oferta_educativa_id', $docente->oferta_educativa_id ?? '') == $oferta->id ? 'selected' : '' }}>
                                    {{ $oferta->nombre_oferta }}
                                </option>
                            @endforeach
                        </select>
                        @error('oferta_educativa_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="periodos_pago_id" class="form-label">Periodo de Pago</label>
                        <select name="periodos_pago_id" id="periodos_pago_id" class="form-select @error('periodos_pago_id') is-invalid @enderror" required>
                            <option value="">Seleccionar periodo</option>
                            @foreach($periodos_pago as $periodo)
                                <option value="{{ $periodo->id }}" {{ old('periodos_pago_id', $docente->periodos_pago_id ?? '') == $periodo->id ? 'selected' : '' }}>
                                    {{ $periodo->concatenado }}
                                </option>
                            @endforeach
                        </select>
                        @error('periodos_pago_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="importe_pago" class="form-label">Importe de Pago Total</label>
                        <input type="number" step="0.01" class="form-control @error('importe_pago') is-invalid @enderror"
                               name="importe_pago" id="importe_pago"
                               value="{{ old('importe_pago', $docente->importe_pago ?? '') }}" required>
                        @error('importe_pago')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="text-end">
                    <a href="{{ route('docentes.index') }}" class="btn btn-danger">Cancelar</a>
                    <button type="submit" class="btn btn-primary">{{ isset($docente) ? 'Actualizar' : 'Registrar' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
