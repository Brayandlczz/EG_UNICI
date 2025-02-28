@extends('layouts.app')

@section('title', 'Lista de Facturas')

@section('content')
<div class="container">
    <h2 class="mt-4 text-primary fw-bold">Lista de Facturas</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <a href="{{ route('facturas.create') }}" class="btn btn-success btn-sm">
                <i class="fa-solid fa-file-invoice"></i> Agregar Factura
            </a>
            <button class="btn btn-danger btn-sm" id="deleteSelected">
                <i class="fa-solid fa-trash-can"></i> Eliminar Seleccionados
            </button>
        </div>
        <div class="d-flex align-items-center">
            <button class="btn btn-outline-secondary btn-sm me-2 p-1" id="sortAsc" title="Ordenar por Fecha Ascendente">
                <i class="fa-solid fa-arrow-up small"></i>
            </button>
            <button class="btn btn-outline-secondary btn-sm p-1" id="sortDesc" title="Ordenar por Fecha Descendente">
                <i class="fa-solid fa-arrow-down small"></i>
            </button>
            <h5 class="fw-bold text-secondary ms-3">Egresos Totales: <span id="totalEgresos" class="text-dark">$0.00</span></h5>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-hover table-sm text-center align-middle compact-table" id="facturasTable">
                <thead class="table-dark">
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Plantel</th>
                        <th>Folio</th>
                        <th>Docente</th>
                        <th>Fecha de Pago</th>
                        <th>Periodo de Pago</th>
                        <th>Mes de Pago</th>
                        <th>Concepto de Pago</th>
                        <th>Banco</th>
                        <th>Importe</th>
                        <th>Forma de Pago</th>
                        <th>Factura PDF</th>
                        <th>Factura XML</th>
                        <th>Comprobante de Pago</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($facturas as $factura)
                        @php $total += $factura->importe; @endphp
                        <tr data-date="{{ $factura->fecha_pago }}">
                            <td><input type="checkbox" class="selectItem"></td>
                            <td>{{ $factura->id }}</td>
                            <td>{{ $factura->plantel }}</td>
                            <td>{{ $factura->folio }}</td>
                            <td>{{ $factura->docente }}</td>
                            <td class="fechaPago">{{ \Carbon\Carbon::parse($factura->fecha_pago)->format('d/m/Y') }}</td>
                            <td>{{ $factura->periodo_pago }}</td>
                            <td>{{ $factura->mes_pago }}</td>
                            <td>{{ $factura->concepto_pago }}</td>
                            <td>{{ $factura->banco }}</td>
                            <td class="fw-bold text-success monto">${{ number_format($factura->importe, 2) }}</td>
                            <td>{{ $factura->forma_pago }}</td>
                            <td>
                                @if($factura->factura_pdf)
                                    <a href="{{ asset('storage/' . $factura->factura_pdf) }}" target="_blank">Ver PDF</a>
                                @else
                                    <span class="text-muted">No disponible</span>
                                @endif
                            </td>
                            <td>
                                @if($factura->factura_xml)
                                    <a href="{{ asset('storage/' . $factura->factura_xml) }}" target="_blank">Ver XML</a>
                                @else
                                    <span class="text-muted">No disponible</span>
                                @endif
                            </td>
                            <td>
                                @if($factura->comprobante_pago)
                                    <a href="{{ asset('storage/' . $factura->comprobante_pago) }}" target="_blank">Ver Comprobante</a>
                                @else
                                    <span class="text-muted">No disponible</span>
                                @endif
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
        let totalEgresos = 0;
        document.querySelectorAll('.monto').forEach(function(el) {
            totalEgresos += parseFloat(el.innerText.replace('$', '').replace(',', ''));
        });
        document.getElementById('totalEgresos').innerText = '$' + totalEgresos.toFixed(2);

        function sortTable(order) {
            let table = document.getElementById("facturasTable").getElementsByTagName('tbody')[0];
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
    });
</script>
@endsection
