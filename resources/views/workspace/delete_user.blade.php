@if(session('delete_user_success'))
<p class="success-message">{{ session('delete_user_success') }}</p>
@endif

<form id="delete-user-form" action="{{ route('users.delete') }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
    <label for="user_id"><strong>Sélectionnez un utilisateur à supprimer :</strong></label>
    <select name="user_id" id="user_id">
        @foreach($users as $user)
        <option value="{{ $user->user_id }}">{{ $user->username }}</option>
        @endforeach
    </select>

    <div class="delete-user-btn">
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </div>


    <div>
        <a href="{{ route('mySpace') }}">Retour</a>
    </div>
</form>