@extends('layouts.app')

@section('title', isset($user) ? 'Editar Usuario' : 'Registrar Usuario')

@section('content')
<div class="container">
    <h2 class="mt-4">Usuarios <span class="text-muted">{{ isset($user) ? 'Edición' : 'Registro' }}</span></h2>

    <div class="card mt-3">
        <div class="card-header bg-primary text-white">{{ isset($user) ? 'Editar Datos del Usuario' : 'Datos del Usuario' }}</div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ isset($user) ? route('usuarios.update', $user->id) : route('usuarios.store') }}" method="POST">
                @csrf
                @if(isset($user))
                    @method('PUT') 
                @endif

                <div class="mb-3">
                    <label class="form-label" for="name">Nombre de Usuario</label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name"
                        class="form-control @error('name') is-invalid @enderror" 
                        value="{{ old('name', $user->name ?? '') }}" 
                        required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email"
                        class="form-control @error('email') is-invalid @enderror" 
                        value="{{ old('email', $user->email ?? '') }}" 
                        required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label" for="role">Rol</label>
                    <select name="rol_id" id="role" class="form-control @error('rol_id') is-invalid @enderror" required>
                        <option value="" disabled {{ old('rol_id', $user->rol_id ?? '') == '' ? 'selected' : '' }}>Seleccione un rol</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" 
                                {{ old('rol_id', $user->rol_id ?? '') == $role->id ? 'selected' : '' }}>
                                {{ $role->rol }}
                            </option>
                        @endforeach
                    </select>
                    @error('rol_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="password">Contraseña</label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password"
                        class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="password_confirmation">Confirmar Contraseña</label>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        id="password_confirmation"
                        class="form-control @error('password_confirmation') is-invalid @enderror">
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <a href="{{ route('usuarios.index') }}" class="btn btn-danger">Cancelar</a>
                    <button type="submit" class="btn btn-primary">{{ isset($user) ? 'Actualizar' : 'Guardar' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
