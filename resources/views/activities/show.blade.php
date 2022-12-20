@extends('layouts.app')
@section('styles')
    @vite('resources/css/activities.css')
@endsection
@section('content')
    <div class="container">
        <div class="card card-dataTable">
            <div class="card-body">
                <h1 class="text-center">
                    {{ $activity->title }}
                </h1>
                <div class="row">
{{--                    div de cuatro columnas descripcion de la actividad--}}
                    <div class="col-md-5 offset-1">
                        <div class="card mb-2">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Descripcion
                                </h3>
                                <p>{{ $activity->description }}</p>
                            </div>
                        </div>
                        <div class="card my-2">
                            <div class="card-header">
                                <h3 class="card-title col-md-12">
                                    Actividades relacionadas
                                </h3>
                                <ul class="col-md-12">
                                    @for($i=0;$i<=10;$i++)
                                        <li>Actividad {{ $i }}</li>
                                    @endfor
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card mb-2">
                            <div class="card-header">
                                <h3 class="card-title
                                ">Disponibilidad</h3>
                                <span>Desde:<b>{{ $activity->start_date }}</b> Hasta:<b>{{ $activity->end_date }}</b></span>
                            </div>
                        </div>
                        <div class="card my-2">
                            <div class="card-header">
                                <h3 class="card-title
                                ">Precio por persona</h3>
                                <span id="price">{{ $activity->price }}</span>
                            </div>
                        </div>
{{--                        form para reservar--}}
                        <form action="{{ route('reserve.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                            <div class="card my-2">
                                <div class="card-header justify-content-end">
                                    <div class="form-group me-2 @error('date') text-danger @enderror">
                                        <label for="date">
                                            @error('date') * @enderror Fecha
                                        </label>
                                        <input type="date"
                                               name="date" id="date"
                                               class="form-control" value="{{ old('date') }}">
                                    </div>
                                    <div class="form-group @error('participants') text-danger @enderror">
                                        <label for="participants">
                                            @error('participants') * @enderror Participantes
                                        </label>
                                        <input type="number"
                                               min="" name="participants"
                                               id="participants" class="form-control"
                                               value="{{ old('participants') ?? 1 }}">
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <button class="btn btn-primary">Reservar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @vite('resources/js/activitiesShow.js')
@endsection
