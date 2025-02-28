@extends('layouts.app')

@section('title', isset($banco) ? 'Editar Cuenta Bancaria' : 'Registrar Cuenta Bancaria')

@section('content')
<div class="container">
    <h2 class="mt-4">Cuentas Bancarias <span class="text-muted">{{ isset($banco) ? 'Edición' : 'Registro' }}</span></h2>

    <div class="card mt-3">
        <div class="card-header bg-primary text-white">{{ isset($banco) ? 'Editar Datos de la Cuenta Bancaria' : 'Datos de la Cuenta Bancaria' }}</div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ isset($banco) ? route('bancos.update', $banco->id) : route('bancos.store') }}" method="POST">
                @csrf
                @if(isset($banco))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="banco" class="form-label">Nombre del Banco</label>
                    <input type="text" class="form-control @error('banco') is-invalid @enderror" 
                           id="banco" name="banco" 
                           value="{{ old('banco', $banco->banco ?? '') }}" required>
                    @error('banco')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="numero_cuenta" class="form-label">Número de Cuenta</label>
                    <input type="text" class="form-control @error('numero_cuenta') is-invalid @enderror" 
                           id="numero_cuenta" name="numero_cuenta" 
                           value="{{ old('numero_cuenta', $banco->numero_cuenta ?? '') }}" required>
                    @error('numero_cuenta')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="razon_social" class="form-label">Razón Social</label>
                    <input type="text" class="form-control @error('razon_social') is-invalid @enderror" 
                           id="razon_social" name="razon_social" 
                           value="{{ old('razon_social', $banco->razon_social ?? '') }}" required>
                    @error('razon_social')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <a href="{{ route('bancos.index') }}" class="btn btn-danger">Cancelar</a>
                    <button type="submit" class="btn btn-primary">{{ isset($banco) ? 'Actualizar' : 'Guardar' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
