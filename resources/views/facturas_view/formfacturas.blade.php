@extends('layouts.app')

@section('title', 'Egresos UNICI')

@section('content')
<div class="container">
    <h2 class="mt-4">Factura de Pago <span class="text-muted">Docentes</span></h2>

    <div class="card mt-3">
        <div class="card-header bg-primary text-white">Datos de la factura de pago</div>
        <div class="card-body">
            <form action="{{ route('facturas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">Plantel</label>
                        <select class="form-select" name="plantel" required>
                            <option selected>Seleccione un plantel</option>
                            <option value="UNICI TUXTLA">UNICI TUXTLA</option>
                            <option value="UNICI TAPACHULA">UNICI TAPACHULA</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Folio</label>
                        <input type="text" class="form-control" name="folio" placeholder="Número de Folio">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Docente</label>
                        <input type="text" class="form-control" name="docente" id="docente-autocomplete" placeholder="Ingrese el nombre del docente" autocomplete="off">
                        <ul id="docente-list" class="list-group position-absolute d-none"></ul>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Fecha de Pago</label>
                        <input type="date" class="form-control" name="fecha_compra">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Periodo de Pago</label>
                        <select class="form-select" name="periodo_pago" required>
                            <option selected>Seleccione un periodo de pago</option>
                            @foreach($periodos as $periodo)
                                <option value="{{ $periodo->id }}">{{ $periodo->concatenado }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label">Mes de Pago</label>
                        <input type="month" class="form-control" name="mes_pago">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Concepto de Pago</label>
                        <select class="form-select" name="concepto_pago" required>
                            <option selected>Seleccione un concepto</option>
                            @foreach($conceptos as $concepto)
                                <option value="{{ $concepto->id }}">{{ $concepto->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Banco</label>
                        <select class="form-select" name="banco" required>
                            <option selected>Seleccione un banco</option>
                            @foreach($bancos as $banco)
                                <option value="{{ $banco->id }}">{{ $banco->banco }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Importe</label>
                        <input type="number" class="form-control" name="importe" step="1000.0" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Forma de Pago</label>
                        <select class="form-select" name="forma_pago" required>
                            <option selected>Seleccione una forma de pago</option>
                            <option value="Transferencia">Transferencia</option>
                            <option value="Efectivo">Efectivo</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Selecciona la factura</label>
                        <input type="file" class="form-control" name="factura">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Seleccione el XML</label>
                        <input type="file" class="form-control" name="xml">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Seleccione el comprobante de pago</label>
                        <input type="file" class="form-control" name="comprobante">
                    </div>
                </div>

                <div class="text-end">
                    <button type="reset" class="btn btn-danger">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script src="{{ asset('js/ac_docentes.js') }}"></script>
@endsection
