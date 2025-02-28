@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
<div class="container">
    <h2 class="mt-4 text-primary fw-bold">Usuarios</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <a href="{{ route('usuarios.create') }}" class="btn btn-success">
                <i class="fa-solid fa-plus"></i> Agregar Usuario
            </a>
            <button type="button" class="btn btn-danger" id="deleteSelected">
                <i class="fa-solid fa-trash"></i> Eliminar Seleccionados
            </button>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <form id="deleteForm" action="{{ route('usuarios.destroyMultiple') }}" method="POST">
                @csrf
                @method('DELETE')

                <table class="table table-hover text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th><input type="checkbox" id="selectAll"></th>
                            <th>ID</th>
                            <th>Nombre de Usuario</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    <input type="checkbox" class="selectItem" value="{{ $user->id }}">
                                </td>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ route('usuarios.edit', $user->id) }}" class="btn btn-warning btn-sm" title="Editar">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>

                                    <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('selectAll').addEventListener('click', function() {
        const isChecked = this.checked;
        document.querySelectorAll('.selectItem').forEach(item => {
            item.checked = isChecked;
        });
    });

    document.getElementById('deleteSelected').addEventListener('click', function() {
        const selectedIds = [];
        document.querySelectorAll('.selectItem:checked').forEach(item => {
            selectedIds.push(item.value);
        });

        if (selectedIds.length === 0) {
            alert('Por favor selecciona al menos un usuario.');
            return;
        }

        if (confirm('¿Seguro que deseas eliminar los usuarios seleccionados?')) {
            const form = document.getElementById('deleteForm');

            document.querySelectorAll('.dynamic-input').forEach(e => e.remove());

            selectedIds.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'usuarios[]'; 
                input.value = id;
                input.classList.add('dynamic-input');
                form.appendChild(input);
            });

            form.submit();
        }
    });
</script>
@endsection
