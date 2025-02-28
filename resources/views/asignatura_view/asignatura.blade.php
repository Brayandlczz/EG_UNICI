@extends('layouts.app')

@section('title', isset($asignatura) ? 'Editar Asignatura' : 'Registrar Asignatura')

@section('content')
<div class="container">
    <h2 class="mt-4">
        Asignaturas <span class="text-muted">{{ isset($asignatura) ? 'Edición' : 'Registro' }}</span>
    </h2>

    <div class="card mt-3">
        <div class="card-header bg-primary text-white">
            {{ isset($asignatura) ? 'Editar Asignatura' : 'Datos de la Asignatura' }}
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ isset($asignatura) ? route('asignaturas.update', $asignatura->id) : route('asignaturas.store') }}" method="POST">
                @csrf
                @if(isset($asignatura))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label class="form-label" for="nombre_asignatura">Nombre de la Asignatura</label>
                    <input 
                        type="text" 
                        name="nombre_asignatura" 
                        id="nombre_asignatura"
                        class="form-control @error('nombre_asignatura') is-invalid @enderror" 
                        value="{{ old('nombre_asignatura', $asignatura->nombre_asignatura ?? '') }}" 
                        required>
                    @error('nombre_asignatura')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <a href="{{ route('asignaturas.index') }}" class="btn btn-danger">Cancelar</a>
                    <button type="submit" class="btn btn-primary">
                        {{ isset($asignatura) ? 'Actualizar' : 'Guardar' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
