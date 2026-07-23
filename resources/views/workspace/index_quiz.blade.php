@if(session('edit-quiz-success'))
<div class="alert alert-success">
    {{ session('edit-quiz-success') }}
</div>
@endif

@if(session('delete-quiz-success'))
<div class="alert alert-success">
    {{ session('delete-quiz-success') }}
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

<div id="index-quiz-mod-sup" class="container" style="display: none;">
    <h1>Liste des Quizzes</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($quizzes as $quiz)
            <tr>
                <td>{{ $quiz->title }}</td>
                <td>{{ $quiz->status ? 'Actif' : 'Inactif' }}</td>
                <td>
                    <a href="{{ route('quizzes.edit', $quiz->quiz_id) }}" class="btn btn-primary">Modifier</a>

                    <form action="{{ route('quizzes.delete', $quiz->quiz_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>