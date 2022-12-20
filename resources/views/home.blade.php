@extends('layouts.app')
@section('styles')
    @vite('resources/css/home.css')
@endsection
@section('content')
    <div class="container">
        <div class="card card-bienvenido">
            <div class="card-body">
                <h1 class="card-title text-center">Bienvenido, busquemos una actividad</h1>
                <form action="{{ route('activities.search') }}" method="get">
                    <div class="row">
                        <div class="col-md-4 offset-2">
                            <div class="form-group @error('date') has-error @enderror">
                                <label for="date">
                                    Fecha
                                </label>
                                <input type="date"
                                       name="date" id="date"
                                       class="form-control" value="{{ old('date') }}">
                                @error('fecha')
                                <span class="help-block
                                text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group @error('participants') has-error @enderror">
                                <label for="participants">
                                    Participantes
                                </label>
                                <input type="number"
                                       min="" name="participants"
                                       id="participants" class="form-control"
                                       value="{{ old('participants') ?? 1 }}">
                                @error('participantes')
                                    <span class="help-block text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <button type="submit" id="search-activity" class="btn btn-primary btn-block">
                            Buscar
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @include('activities.search_result')
    </div>

@endsection
@section('scripts')
    @vite('resources/js/home.js')
@endsection
