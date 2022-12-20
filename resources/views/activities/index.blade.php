@extends('layouts.app')
@section('styles')
    @vite('resources/css/activities.css')
@endsection
@section('content')
    <div class="container">
        <div class="card card-dataTable">
            <div class="card-body">
                <h1 class="text-center">
                    Actividades
                </h1>
                <table class="table table-striped table-bordered table-hover" id="activities-table">
                    <thead>
                        <tr>
                            <th>Actividad</th>
                            <th>Descripcion</th>
                            <th>Precio</th>
                            <th>Desde</th>
                            <th>Hasta</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @vite('resources/js/activities.js')
@endsection
