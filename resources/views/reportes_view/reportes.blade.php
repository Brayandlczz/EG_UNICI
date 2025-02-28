@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Reportes por Filtros</h2>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-calendar"></i> Reporte por Rango de Fechas
                </div>
                <div class="card-body">
                    <label for="plantel">Seleccionar Plantel:</label>
                    <select class="form-control mb-2" id="plantel">
                        <option value="plantel1">Plantel 1</option>
                        <option value="plantel2">Plantel 2</option>
                        <option value="plantel3">Plantel 3</option>
                    </select>

                    <label for="forma_pago">Forma de Pago:</label>
                    <select class="form-control mb-2" id="forma_pago">
                        <option value="efectivo">Efectivo</option>
                        <option value="transferencia">Transferencia</option>
                        <option value="tarjeta">Tarjeta</option>
                    </select>

                    <label for="banco">Banco:</label>
                    <select class="form-control mb-2" id="banco">
                        <option value="bbva">BBVA</option>
                        <option value="santander">Santander</option>
                        <option value="banorte">Banorte</option>
                    </select>

                    <label for="fecha_inicio">Fecha de Inicio:</label>
                    <input type="date" class="form-control mb-2" id="fecha_inicio">
                    
                    <label for="fecha_fin">Fecha de Fin:</label>
                    <input type="date" class="form-control mb-3" id="fecha_fin">

                    <button class="btn btn-success w-100"><i class="fas fa-file-excel"></i> Generar Reporte Excel</button>
                    <button class="btn btn-danger w-100 mt-2"><i class="fas fa-file-pdf"></i> Generar Reporte PDF</button>
                </div>
            </div>
        </div>

        <!-- Reporte por Mes -->
        <div class="col-md-4">
            <div class="card border-info">
                <div class="card-header bg-info text-white">
                    <i class="fas fa-calendar-alt"></i> Reporte por Mes
                </div>
                <div class="card-body">
                    <label for="plantel_mes">Seleccionar Plantel:</label>
                    <select class="form-control mb-2" id="plantel_mes">
                        <option value="plantel1">Plantel 1</option>
                        <option value="plantel2">Plantel 2</option>
                        <option value="plantel3">Plantel 3</option>
                    </select>

                    <label for="mes">Seleccionar Mes:</label>
                    <select class="form-control mb-3" id="mes">
                        <option value="01">Enero</option>
                        <option value="02">Febrero</option>
                        <option value="03">Marzo</option>
                        <option value="04">Abril</option>
                        <option value="05">Mayo</option>
                        <option value="06">Junio</option>
                        <option value="07">Julio</option>
                        <option value="08">Agosto</option>
                        <option value="09">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>

                    <button class="btn btn-success w-100"><i class="fas fa-file-excel"></i> Generar Reporte Excel</button>
                    <button class="btn btn-danger w-100 mt-2"><i class="fas fa-file-pdf"></i> Generar Reporte PDF</button>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-warning">
                <div class="card-header bg-warning text-dark">
                    <i class="fas fa-clock"></i> Reporte por Periodo de Tiempo
                </div>
                <div class="card-body">
                    <label for="plantel_periodo">Seleccionar Plantel:</label>
                    <select class="form-control mb-2" id="plantel_periodo">
                        <option value="plantel1">Plantel 1</option>
                        <option value="plantel2">Plantel 2</option>
                        <option value="plantel3">Plantel 3</option>
                    </select>

                    <label for="periodo">Seleccionar Periodo:</label>
                    <select class="form-control mb-3" id="periodo">
                        <option value="Q1">Primer Trimestre</option>
                        <option value="Q2">Segundo Trimestre</option>
                        <option value="Q3">Tercer Trimestre</option>
                        <option value="Q4">Cuarto Trimestre</option>
                        <option value="H1">Primer Semestre</option>
                        <option value="H2">Segundo Semestre</option>
                        <option value="A">Año Completo</option>
                    </select>

                    <button class="btn btn-success w-100"><i class="fas fa-file-excel"></i> Generar Reporte Excel</button>
                    <button class="btn btn-danger w-100 mt-2"><i class="fas fa-file-pdf"></i> Generar Reporte PDF</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
