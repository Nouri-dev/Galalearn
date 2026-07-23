@if(session('role_user_create_success'))
    <p class="success-message">{{ session('role_user_create_success') }}</p>
@endif  
@if(session('role_assignment_user_error'))
    <p class="success-message">{{ session('role_assignment_user_error') }}</p>
@endif  
<form id="add-user-role-form" action="{{ route('users.addRole') }}" method="POST" style="display: none;">
    @csrf
    <div class="form-group">
        <label for="user_id">Choisir un utilisateur:</label>
        <select name="user_id" id="user_id" class="form-control">
            @foreach($users as $userItem)
                <option value="{{ $userItem->user_id }}">{{ $userItem->username }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="role">Choisir un rôle:</label>
        <select name="role" id="role" class="form-control">
            <option value="student">Student</option>
            <option value="administrator">Administrator</option>
            <option value="instructor">Instructor</option>
        </select>
    </div>

    <div class="role-user-btn">
      <button type="submit" class="btn btn-primary">Ajouter le rôle</button>  
    </div>
    

    <div>
        <a href="{{ route('mySpace') }}">Retour</a>
    </div>

</form>






