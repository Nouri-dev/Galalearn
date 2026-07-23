
<!-- resources/views/workspace/index_user.blade.php -->
<div id="index-show-user-profile" class="container" style="display: none;">
    <h1>Profil de {{ $user->username }}</h1>

    <div class="row">
        <div class="col-md-6">
            <h3>Informations personnelles</h3>
            <p><strong>Nom utilisateur : </strong>{{ $user->username }}</p>
            <p><strong>Nom : </strong>{{ $user->lastname }}</p>
            <p><strong>Prénom : </strong> {{ $user->firstname }}</p>
            <p><strong>Email : </strong> {{ $user->email }}</p>
            <p><strong>Date de naissance : </strong> {{ $user->birthdate }}</p>
        </div>
    </div>
</div>

