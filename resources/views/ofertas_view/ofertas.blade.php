@extends('layouts.app')

@section('title', isset($oferta) ? 'Editar Oferta Educativa' : 'Registrar Oferta Educativa')

@section('content')
<div class="container">
    <h2 class="mt-4">Ofertas Educativas <span class="text-muted">{{ isset($oferta) ? 'Edición' : 'Registro' }}</span></h2>

    <div class="card mt-3">
        <div class="card-header bg-primary text-white">{{ isset($oferta) ? 'Editar Datos de la Oferta Educativa' : 'Datos de la Oferta Educativa' }}</div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ isset($oferta) ? route('ofertas.update', $oferta->id) : route('ofertas.store') }}" method="POST">
                @csrf
                @if(isset($oferta))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="plantel_id" class="form-label">Seleccionar Plantel</label>
                    <select class="form-control @error('plantel_id') is-invalid @enderror" 
                            id="plantel_id" name="plantel_id" required>
                        <option value="" disabled selected>Seleccione un plantel</option>
                        @foreach($planteles as $plantel)
                            <option value="{{ $plantel->id }}" 
                                    @if(old('plantel_id', $oferta->plantel_id ?? '') == $plantel->id) selected @endif>
                                {{ $plantel->nombre_plantel }}
                            </option>
                        @endforeach
                    </select>
                    @error('plantel_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nombre_oferta" class="form-label">Nombre de la Oferta Educativa</label>
                    <input type="text" class="form-control @error('nombre_oferta') is-invalid @enderror" 
                           id="nombre_oferta" name="nombre_oferta" 
                           value="{{ old('nombre_oferta', $oferta->nombre_oferta ?? '') }}" required>
                    @error('nombre_oferta')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <a href="{{ route('ofertas.index') }}" class="btn btn-danger">Cancelar</a>
                    <button type="submit" class="btn btn-primary">{{ isset($oferta) ? 'Actualizar Oferta ' : 'Guardar Oferta' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
