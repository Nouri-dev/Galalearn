@extends('layouts.app')

@section('title', 'Page non trouvée')

@section('content')
    <div class="container mt-5 text-center">
        <h1 class="display-1">404</h1>
        <img src="{{ asset('images/404.png') }}" alt="Page non trouvée" class="img-fluid mt-4" style="max-width: 400px;">
        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Retourner à l'accueil</a>
    </div>
@endsection
