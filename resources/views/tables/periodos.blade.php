@extends('layouts.app')

@section('title', 'Periodos de Pago')

@section('content')
<div class="container">
    <h2 class="mt-4 text-primary fw-bold">Periodos de Pago</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <a href="{{ route('periodos.create') }}" class="btn btn-success">
                <i class="fa-solid fa-plus"></i> Agregar Periodo
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
            <form id="deleteForm" action="{{ route('periodos.destroyMultiple') }}" method="POST">
                @csrf
                @method('DELETE')

                <table class="table table-hover text-center align-middle" id="periodosTable">
                    <thead class="table-dark">
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Inicio del Periodo</th>
                            <th>Fin del Periodo</th>
                            <th>Tipo de Periodo</th>
                            <th>Resumen</th> <!-- Nueva columna para resumen -->
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($periodos as $periodo)
                            <tr>
                                <td><input type="checkbox" class="selectItem" value="{{ $periodo->id }}"></td>
                                <td>{{ $periodo->id }}</td>
                                <td class="start-date">
                                    {{ \Carbon\Carbon::parse($periodo->inicio_periodo)->locale('es')->isoFormat('MMMM D, YYYY') }}
                                </td>
                                <td class="end-date">
                                    {{ \Carbon\Carbon::parse($periodo->fin_periodo)->locale('es')->isoFormat('MMMM D, YYYY') }}
                                </td>
                                <td>{{ $periodo->tipo_periodo }}</td>
                                <td>{{ $periodo->concatenado }}</td> 
                                <td>
                                    <a href="{{ route('periodos.edit', $periodo->id) }}" class="btn btn-warning btn-sm" title="Editar">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                    <form action="{{ route('periodos.destroy', $periodo->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm('¿Seguro que deseas eliminar este periodo?')">
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
    document.getElementById('deleteSelected').addEventListener('click', function() {
        const selectedIds = [];
        document.querySelectorAll('.selectItem:checked').forEach(item => {
            selectedIds.push(item.value);
        });

        if (selectedIds.length === 0) {
            alert('Por favor selecciona al menos un periodo.');
            return;
        }

        if (confirm('¿Seguro que deseas eliminar los periodos seleccionados?')) {
            const form = document.getElementById('deleteForm');
            
            document.querySelectorAll('.dynamic-input').forEach(e => e.remove());
            
            selectedIds.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'periodos[]';
                input.value = id;
                input.classList.add('dynamic-input');
                form.appendChild(input);
            });
            form.submit();
        }
    });
</script>
@endsection
