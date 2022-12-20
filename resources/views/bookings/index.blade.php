@extends('layouts.app')
@section('styles')
@endsection
@section('content')
    <div class="container">
        <div class="card card-dataTable">
            <div class="card-body">
                <h1 class="text-center">
                    Mis Reservaciones
                </h1>
                <table class="table table-striped table-bordered table-hover" id="bookings-table">
                    <thead>
                        <tr>
                            <th>Actividad</th>
                            <th>Descripcion</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @vite('resources/js/bookings.js')
@endsection
