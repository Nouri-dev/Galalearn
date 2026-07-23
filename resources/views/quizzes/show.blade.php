<!-- resources/views/quizzes/show.blade.php -->

@extends('layouts.app')

@section('title', 'GALALEARN')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/quiz_cont_blo.css') }}">
@endsection


@section('content')

<div class="quiz-show-container">

    <div class="quiz-show-header">
        <h1>{{ $quiz->title }}</h1>
    </div>

    <div class="quiz-show-content">

        @if($quiz->questions->isNotEmpty())

        <form method="POST" action="{{ route('quizzes.submit', [$category->category_id, $subCategory->category_id, $quiz->quiz_id]) }}" class="quiz-show-form">
            @csrf
            @foreach($quiz->questions as $index => $question)
            <div class="quiz-show-question">
                <p class="quiz-show-question-title">Question {{ $index + 1 }}: {{ $question->text }}</p>
                @if($question->responses->isNotEmpty())
                <ul class="quiz-show-response-list">
                    @foreach($question->responses as $response)
                    <li class="quiz-show-response-item">
                        <label class="quiz-show-response-label">
                            <input type="checkbox" name="answers[{{ $question->question_id }}][]" value="{{ $response->response_id }}" class="quiz-show-checkbox">
                            {{ $response->text }}
                        </label>
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
            @endforeach
            <div class="div-quiz-show-submit-button">
                <button type="submit" class="quiz-show-submit-button">Finaliser le Quiz</button>
            </div>

        </form>
        @endif

    </div>

</div>





@endsection