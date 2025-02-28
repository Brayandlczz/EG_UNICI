@extends('layouts.app')

@section('title', 'Cuentas Bancarias')

@section('content')
<div class="container">
    <h2 class="mt-4 text-primary fw-bold">Cuentas Bancarias</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <a href="{{ route('bancos.create') }}" class="btn btn-success">
                <i class="fa-solid fa-file-invoice"></i> Agregar Cuenta
            </a>
            <button class="btn btn-danger" id="deleteSelected">
                <i class="fa-solid fa-trash-can"></i> Eliminar Seleccionados
            </button>
        </div>
        <div class="d-flex align-items-center">
            <button class="btn btn-outline-secondary me-2 p-1" id="sortAsc" title="Ordenar por ID Ascendente">
                <i class="fa-solid fa-arrow-up small"></i>
            </button>
            <button class="btn btn-outline-secondary p-1" id="sortDesc" title="Ordenar por ID Descendente">
                <i class="fa-solid fa-arrow-down small"></i>
            </button>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <form id="deleteForm" action="{{ route('bancos.destroyMultiple') }}" method="POST">
                @csrf
                
                @method('DELETE')
                <table class="table table-hover text-center align-middle" id="cuentasTable">
                    <thead class="table-dark">
                        <tr>
                            <th></th>
                            <th class="text-center align-middle text-nowrap">ID</th>
                            <th class="text-center align-middle text-nowrap">Nombre del Banco</th>
                            <th class="text-center align-middle text-nowrap">Número de Cuenta</th>
                            <th class="text-center align-middle text-nowrap">Razón Social</th>
                            <th class="text-center align-middle text-nowrap">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cuentas as $cuenta)
                            <tr>
                                <td><input type="checkbox" class="selectItem" value="{{ $cuenta->id }}"></td>
                                <td>{{ $cuenta->id }}</td>
                                <td>{{ $cuenta->banco }}</td>
                                <td>{{ $cuenta->numero_cuenta }}</td>
                                <td>{{ $cuenta->razon_social }}</td>
                                <td>
                                    <a href="{{ route('bancos.edit', $cuenta->id) }}" class="btn btn-warning btn-sm" title="Editar">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                    <form action="{{ route('bancos.destroy', $cuenta->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm('¿Seguro que deseas eliminar esta cuenta?')">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function sortTable(order) {
            let table = document.getElementById("cuentasTable").getElementsByTagName('tbody')[0];
            let rows = Array.from(table.getElementsByTagName('tr'));

            rows.sort(function(a, b) {
                let idA = parseInt(a.cells[1].innerText);
                let idB = parseInt(b.cells[1].innerText);
                return order === 'asc' ? idA - idB : idB - idA;
            });

            table.innerHTML = "";
            rows.forEach(row => table.appendChild(row));
        }

        document.getElementById("sortAsc").addEventListener("click", function() {
            sortTable('asc');
        });

        document.getElementById("sortDesc").addEventListener("click", function() {
            sortTable('desc');
        });

        document.getElementById('deleteSelected').addEventListener('click', function() {
            const selectedIds = [];
            document.querySelectorAll('.selectItem:checked').forEach(item => {
                selectedIds.push(item.value);
            });

            if (selectedIds.length === 0) {
                alert('Por favor selecciona al menos una cuenta.');
                return;
            }

            if (confirm('¿Seguro que deseas eliminar las cuentas seleccionadas?')) {
                const form = document.getElementById('deleteForm');
                document.querySelectorAll('.dynamic-input').forEach(e => e.remove());
                selectedIds.forEach(id => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'cuentas[]';
                    input.value = id;
                    input.classList.add('dynamic-input');
                    form.appendChild(input);
                });
                form.submit();
            }
        });
    });
</script>
@endsection
