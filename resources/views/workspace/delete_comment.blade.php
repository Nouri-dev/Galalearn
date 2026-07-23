<!-- Formulaire de suppression de commentaire -->



@if(session('delete_comment_success'))
<div class="alert alert-success">
    {{ session('delete_comment_success') }}
</div>
@endif

<form id="delete-comment-form" action="{{ route('comments.delete') }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')

    <div class="form-group delete-comment-group">
    <label for="comment_id" class="delete-comment-label">Choisir un commentaire:</label>
        <select name="comment_id" id="comment_id" class="form-control delete-comment-select">
            @foreach($comments as $comment)
            <option value="{{ $comment->comment_id }}">{{ $comment->text }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-danger delete-comment-btn">Supprimer le commentaire</button>

    <div class="delete-comment-return">
        <a href="{{ route('mySpace') }}">Retour</a>
    </div>
</form>

