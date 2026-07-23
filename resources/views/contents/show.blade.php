<!-- resources/views/contents/show.blade.php -->

@extends('layouts.app')

@section('title', 'GALALEARN')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/quiz_cont_blo.css') }}">
@endsection


@section('content')

<div class="cours-container">
    @if($content->url_media)
    <div class="cours-image">
        <img src="{{ asset('storage/' . $content->url_media) }}" alt="{{ $content->title }}">
    </div>
    @endif

    <div class="cours-title">
        <h1>{{ $content->title }}</h1>   
    </div>

    <div class="cours-text">
        <p>{!! nl2br(e($content->text)) !!}</p>    
    </div>

    <div class="cours-footer">
        <a href="{{ route('home') }}" class="cours-link">Retour à l'accueil</a>
        <a href="{{ route('categories.showSubCategory', [$category->category_id, $subCategory->category_id]) }}" class="cours-link">Retour</a>
        <p>Posté le : {{ $content->created_at }} , modifié le : {{ $content->updated_at }}</p>
    </div>
</div>



@endsection