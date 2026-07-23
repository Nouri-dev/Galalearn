@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/edit_quiz.css') }}">
@endsection


@section('content')

<div class="container">
    <h1>Modifier le Quiz</h1>

    <form action="{{ route('quizzes.update', $quiz->quiz_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Titre du Quiz:</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $quiz->title) }}" required>
        </div>

        <div class="form-group">
            <label for="status">Statut:</label>
            <select name="status" id="status" class="form-control">
                <option value="1" {{ old('status', $quiz->status) == '1' ? 'selected' : '' }}>Actif</option>
                <option value="0" {{ old('status', $quiz->status) == '0' ? 'selected' : '' }}>Inactif</option>
            </select>
        </div>

        <div class="form-group">
            <label for="category_id">Catégorie:</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="">Sélectionnez une catégorie</option>
                @foreach($categories as $category)
                    <option value="{{ $category->category_id }}" {{ old('category_id', $quiz->category_id) == $category->category_id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="questions">Questions:</label>
            <div id="questions-container">
                @foreach($quiz->questions as $i => $question)
                    <div class="question-group">
                        <input type="hidden" name="questions[{{ $i }}][id]" value="{{ $question->question_id }}"> <!-- Identifiant de la question -->
                        <label>Question {{ $i + 1 }}:</label>
                        <input type="text" name="questions[{{ $i }}][text]" class="form-control mb-2" value="{{ old("questions.$i.text", $question->text) }}" placeholder="Texte de la question" required>

                        <label>Réponses:</label>
                        <div class="responses-group">
                            @foreach($question->responses as $j => $response)
                                <input type="hidden" name="questions[{{ $i }}][responses][{{ $j }}][id]" value="{{ $response->response_id }}"> <!-- Identifiant de la réponse -->
                                <div class="response-item">
                                    <input type="text" name="questions[{{ $i }}][responses][{{ $j }}][text]" class="form-control mb-1" value="{{ old("questions.$i.responses.$j.text", $response->text) }}" placeholder="Texte de la réponse" required>
                                    <input type="hidden" name="questions[{{ $i }}][responses][{{ $j }}][is_correct]" value="0"> <!-- Valeur par défaut pour is_correct -->
                                    <label class="response-checkbox">
                                        <input type="checkbox" name="questions[{{ $i }}][responses][{{ $j }}][is_correct]" value="1" {{ old("questions.$i.responses.$j.is_correct", $response->is_correct) == '1' ? 'checked' : '' }}>
                                        Correcte
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>

        <div>
            <a href="{{ route('mySpace') }}">Retour</a>
        </div>
    </form>
</div>
    
@endsection
