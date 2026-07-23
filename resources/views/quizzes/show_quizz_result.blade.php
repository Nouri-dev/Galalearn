<!-- resources/views/quizzes/show_quizz_result.blade.php -->

@extends('layouts.app')

@section('title', 'GALALEARN')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/quiz_cont_blo.css') }}">
@endsection

@section('content')
<div class="container-result-quiz">
    <div class="result-quiz-title">
        <h1>Résultat du quiz : {{ $quiz->title }}</h1>
    </div>

    <div class="result-quiz-text">
        <p>Vous avez obtenu: {{ number_format($score, 2) }}%</p>

        @if ($score == 100)
        <p>Excellent ! Vous avez obtenu un score parfait !</p>
        @elseif ($score >= 50)
        <p>Bien joué ! Vous avez obtenu un bon score.</p>
        @else
        <p>Vous pouvez faire mieux. Essayez encore !</p>
        @endif
    </div>


    <div class="result-quiz-footer">
        <a href="{{ route('quizzes.show', [$categoryId, $subCategoryId, $quizId]) }}">Recommencer le quiz</a>
        <a href="{{ route('home') }}">Accueil</a>
    </div>


</div>
@endsection