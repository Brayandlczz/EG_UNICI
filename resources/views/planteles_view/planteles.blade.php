@extends('layouts.app')

@section('title', isset($plantel) ? 'Editar Plantel' : 'Registrar Plantel')

@section('content')
<div class="container">
    <h2 class="mt-4">
        Planteles <span class="text-muted">{{ isset($plantel) ? 'Edición' : 'Registro' }}</span>
    </h2>

    <div class="card mt-3">
        <div class="card-header bg-primary text-white">
            {{ isset($plantel) ? 'Editar Plantel' : 'Datos del Plantel' }}
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ isset($plantel) ? route('planteles.update', $plantel->id) : route('planteles.store') }}" method="POST">
                @csrf
                @if(isset($plantel))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label class="form-label" for="nombre_plantel">Nombre del Plantel</label>
                    <input 
                        type="text" 
                        name="nombre_plantel" 
                        id="nombre_plantel"
                        class="form-control @error('nombre_plantel') is-invalid @enderror" 
                        value="{{ old('nombre_plantel', $plantel->nombre_plantel ?? '') }}" 
                        required>
                    @error('nombre_plantel')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <a href="{{ route('planteles.index') }}" class="btn btn-danger">Cancelar</a>
                    <button type="submit" class="btn btn-primary">
                        {{ isset($plantel) ? 'Actualizar' : 'Guardar' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
