@extends('layouts.app')

@section('title', 'Lista de Ofertas Educativas')

@section('content')
<div class="container">
    <h2 class="mt-4 text-primary fw-bold">Lista de Ofertas Educativas</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <a href="{{ route('ofertas.create') }}" class="btn btn-success btn-sm">
                <i class="fa-solid fa-plus"></i> Agregar Oferta Educativa
            </a>
            <button class="btn btn-danger btn-sm" id="deleteSelected">
                <i class="fa-solid fa-trash-can"></i> Eliminar Seleccionados
            </button>
        </div>
        <div class="d-flex align-items-center">
            <h5 class="fw-bold text-secondary ms-3">Total de Ofertas: <span id="totalOfertas" class="text-dark">{{ $ofertas->count() }}</span></h5>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <form id="deleteForm" action="{{ route('ofertas.destroyMultiple') }}" method="POST">
                @csrf
                @method('DELETE')

                <table class="table table-hover table-sm text-center align-middle compact-table" id="ofertasTable">
                    <thead class="table-dark">
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Nombre de la Oferta</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ofertas as $oferta)
                            <tr data-date="{{ $oferta->fecha_inicio }}">
                                <td><input type="checkbox" class="selectItem" value="{{ $oferta->id }}"></td>
                                <td>{{ $oferta->id }}</td>
                                <td>{{ $oferta->nombre_oferta }}</td>
                                <td>
                                    <a href="{{ route('ofertas.edit', $oferta->id) }}" class="btn btn-warning btn-sm" title="Editar">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                    <form action="{{ route('ofertas.destroy', $oferta->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm('¿Seguro que deseas eliminar esta oferta?')">
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
    let totalOfertas = 0;
    document.querySelectorAll('.monto').forEach(function(el) {
        totalOfertas += parseFloat(el.innerText.replace('$', '').replace(',', ''));
    });
    document.getElementById('totalOfertas').innerText = totalOfertas.toFixed(2);
});

        function sortTable(order) {
            let table = document.getElementById("ofertasTable").getElementsByTagName('tbody')[0];
            let rows = Array.from(table.getElementsByTagName('tr'));

            rows.sort(function(a, b) {
                let dateA = new Date(a.dataset.date);
                let dateB = new Date(b.dataset.date);
                return order === 'asc' ? dateA - dateB : dateB - dateA;
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
                alert('Por favor selecciona al menos una oferta.');
                return;
            }

            if (confirm('¿Seguro que deseas eliminar las ofertas seleccionadas?')) {
                const form = document.getElementById('deleteForm');
                document.querySelectorAll('.dynamic-input').forEach(e => e.remove());
                selectedIds.forEach(id => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'ofertas[]';
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
