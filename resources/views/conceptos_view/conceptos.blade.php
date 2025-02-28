@extends('layouts.app')

@section('title', isset($concepto) ? 'Editar Concepto de Pago' : 'Generar Concepto de Pago')

@section('content')
<div class="container">
    <h2 class="mt-4">
        Conceptos de pago <span class="text-muted">{{ isset($concepto) ? 'Edición' : 'Registro' }}</span>
    </h2>

    <div class="card mt-3">
        <div class="card-header bg-primary text-white">
            {{ isset($concepto) ? 'Editar Concepto de Pago' : 'Datos del Concepto de Pago' }}
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ isset($concepto) ? route('conceptos.update', $concepto->id) : route('conceptos.store') }}" method="POST">
                @csrf
                @if(isset($concepto))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label class="form-label" for="descripcion">Descripción</label>
                    <input 
                        type="text" 
                        name="descripcion" 
                        id="descripcion"
                        class="form-control @error('descripcion') is-invalid @enderror" 
                        value="{{ old('descripcion', $concepto->descripcion ?? '') }}" 
                        required>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="status">Estatus</label>
                    <select 
                        name="status" 
                        id="status" 
                        class="form-select @error('status') is-invalid @enderror" 
                        required>
                        <option value="">Seleccione un estatus</option>
                        <option value="Activo" {{ old('status', $concepto->status ?? '') == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ old('status', $concepto->status ?? '') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <a href="{{ route('conceptos.index') }}" class="btn btn-danger">Cancelar</a>
                    <button type="submit" class="btn btn-primary">
                        {{ isset($concepto) ? 'Actualizar' : 'Guardar' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

