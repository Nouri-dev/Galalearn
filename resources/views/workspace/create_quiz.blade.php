@if(session('quiz_create_success'))
<div class="alert alert-success">
    {{ session('quiz_create_success') }}
</div>
@endif
@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<form id="create-quiz-form" action="{{ route('quizzes.create') }}" method="POST" style="display: none;">
    @csrf
    <div class="form-group">
        <label for="title">Titre du Quiz:</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
    </div>

    <div class="form-group">
        <label for="status">Statut:</label>
        <select name="status" id="status" class="form-control">
            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Actif</option>
            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactif</option>
        </select>
    </div>

    <div class="form-group">
        <label for="category_id">Catégorie:</label>
        <select name="category_id" id="category_id" class="form-control" required>
            <option value="">Sélectionnez une catégorie</option>
            @foreach($categories as $category)
            <option value="{{ $category->category_id }}" {{ old('category_id') == $category->category_id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="questions">Questions:</label>
        <div id="questions-container">
            @for ($i = 0; $i < 10; $i++)
                <div class="question-group">
                    <label>Question {{ $i + 1 }}:</label>
                    <input type="text" name="questions[{{ $i }}][text]" class="form-control mb-2" value="{{ old("questions.$i.text") }}" placeholder="Texte de la question" required>

                    <label>Réponses:</label>
                    <div class="responses-group">
                        @for ($j = 0; $j < 3; $j++)
                            <div class="response-item">
                                <input type="text" name="questions[{{ $i }}][responses][{{ $j }}][text]" class="form-control mb-1" value="{{ old("questions.$i.responses.$j.text") }}" placeholder="Texte de la réponse" required>
                                <div class="response-checkbox">
                                    <input type="hidden" name="questions[{{ $i }}][responses][{{ $j }}][is_correct]" value="0"> <!-- Valeur par défaut pour is_correct -->
                                    <label>
                                        <input type="checkbox" name="questions[{{ $i }}][responses][{{ $j }}][is_correct]" value="1" {{ old("questions.$i.responses.$j.is_correct") == '1' ? 'checked' : '' }}>
                                        Correcte
                                    </label>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <div class="quizz-form-btn">
        <button type="submit" class="btn btn-primary">Créer</button>
    </div>

    <div>
        <a href="{{ route('mySpace') }}">Retour</a>
    </div>
</form>
