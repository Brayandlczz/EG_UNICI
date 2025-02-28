@extends('layouts.app')

@section('title', 'Docentes')

@section('content')
<div class="container">
    <h2 class="mt-4 text-primary fw-bold">Docentes</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <a href="{{ route('docentes.create') }}" class="btn btn-success">
                <i class="fa-solid fa-file-invoice"></i> Agregar Docente
            </a>
            <button class="btn btn-danger" id="deleteSelected">
                <i class="fa-solid fa-trash-can"></i> Eliminar Seleccionados
            </button>
        </div>
        <div class="d-flex align-items-center">
            <!-- Botones de ordenación -->
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
            <table class="table table-hover text-center align-middle" id="docentesTable">
                <thead class="table-dark">
                    <tr>
                        <th></th>
                        <th class="text-center align-middle text-nowrap">ID</th>
                        <th class="text-center align-middle text-nowrap">Nombre del Docente</th>
                        <th class="text-center align-middle text-nowrap">Asignatura que Imparte</th>
                        <th class="text-center align-middle text-nowrap">Oferta Educativa</th>
                        <th class="text-center align-middle text-nowrap">Periodo</th>
                        <th class="text-center align-middle text-nowrap">Importe Total de Pago</th>
                        <th class="text-center align-middle text-nowrap">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($docentes as $docente)
                        <tr>
                            <td><input type="checkbox" class="selectItem"></td>
                            <td>{{ $docente->id }}</td>
                            <td>{{ $docente->nombre_docente }}</td>
                            <td>{{ $docente->asignatura }}</td>
                            <td>{{ $docente->oferta_educativa_id }}</td>
                            <td>{{ $docente->periodos_pago_id }}</td>
                            <td>{{ $docente->importe_pago }}</td>
                            <td>
                                <a href="{{ route('docentes.edit', $docente->id) }}" class="btn btn-warning btn-sm" title="Editar">
                                    <i class="fa-solid fa-edit"></i>
                                </a>

                                <form action="{{ route('docentes.destroy', $docente->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm('¿Seguro que deseas eliminar este docente?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function sortTable(order) {
            let table = document.getElementById("docentesTable").getElementsByTagName('tbody')[0];
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

        document.getElementById("deleteSelected").addEventListener("click", function() {
            let selectedIds = [];
            document.querySelectorAll(".selectItem:checked").forEach(function(item) {
                selectedIds.push(item.closest("tr").cells[1].innerText);
            });

            if (selectedIds.length > 0) {
                fetch("{{ route('docentes.deleteSelected') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ docentes_ids: selectedIds })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
            } else {
                alert("Seleccione al menos un docente.");
            }
        });
    });
</script>
@endsection
