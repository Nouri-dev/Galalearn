
@if(session('delete-content-success'))
<div class="alert alert-success">
    {{ session('delete-content-success') }}
</div>
@endif

@if(session('edit-content-success'))
<div class="alert alert-success">
    {{ session('edit-content-success') }}
</div>
@endif
<div id="index-content-mod-sup" class="container" style="display: none;">
    <h1>Liste des Contenus</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contents as $content)
            <tr>
                <td>{{ $content->title }}</td>
                <td>{{ $content->status ? 'Actif' : 'Inactif' }}</td>
                <td>
                    <a href="{{ route('contents.edit', $content->content_id) }}" class="btn btn-primary">Modifier</a>

                    <form action="{{ route('contents.delete', $content->content_id) }}" method="POST" style="display:inline;">
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