@extends('auth.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5 text-center">
                    <!-- Logo -->
                    <img src="{{ asset('images/uniciflama.png') }}" alt="Logo" class="mb-3" style="width: 30px; height: auto;">
                    
                    <h3 class="mb-4 fw-bold">Bienvenido</h3>
                    <p class="text-muted">Ingresa tus credenciales para acceder</p>

                    <form method="POST" action="/login">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control rounded-pill" id="email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control rounded-pill" id="password" name="password" required>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Recuérdame</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 rounded-pill">Iniciar sesión</button>
                    </form>

                    <hr class="my-4">
                    
                    <div class="text-center">
                        <p class="mb-0">¿No tienes una cuenta? <a href="{{ route('register') }}" class="text-decoration-none">Regístrate</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection