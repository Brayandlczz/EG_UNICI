@extends('layouts.app')

@section('title', 'Planteles')

@section('content')
<div class="container">
    <h2 class="mt-4 text-primary fw-bold">Planteles</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <a href="{{ route('planteles.create') }}" class="btn btn-success">
                <i class="fa-solid fa-plus"></i> Agregar Plantel
            </a>
            <button type="button" class="btn btn-danger" id="deleteSelected">
                <i class="fa-solid fa-trash"></i> Eliminar Seleccionados
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
            <form id="deleteForm" action="{{ route('planteles.destroyMultiple') }}" method="POST">
                @csrf
                @method('DELETE')

                <table class="table table-hover text-center align-middle" id="plantelesTable">
                    <thead class="table-dark">
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($planteles as $plantel)
                            <tr>
                                <td>
                                    <input type="checkbox" class="selectItem" value="{{ $plantel->id }}">
                                </td>
                                <td>{{ $plantel->id }}</td>
                                <td>{{ $plantel->nombre_plantel }}</td>
                                <td>
                                    <a href="{{ route('planteles.edit', $plantel->id) }}" class="btn btn-warning btn-sm" title="Editar">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>

                                    <form action="{{ route('planteles.destroy', $plantel->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm('¿Seguro que deseas eliminar este plantel?')">
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
    document.addEventListener('DOMContentLoaded', function() {
        function sortTable(order) {
            let table = document.getElementById("plantelesTable").getElementsByTagName('tbody')[0];
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
                alert('Por favor selecciona al menos un plantel.');
                return;
            }

            if (confirm('¿Seguro que deseas eliminar los planteles seleccionados?')) {
                const form = document.getElementById('deleteForm');
                document.querySelectorAll('.dynamic-input').forEach(e => e.remove());
                selectedIds.forEach(id => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'planteles[]';  
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
