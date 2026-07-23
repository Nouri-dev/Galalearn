@if(session('delete-blog-success'))
<div class="alert alert-success">
    {{ session('delete-blog-success') }}
</div>
@endif

@if(session('edit-blog-success'))
        <div class="alert alert-success">
            {{ session('edit-blog-success') }}
        </div>
@endif

<div id="index-blog-mod-sup" class="container" style="display: none;">
    <h1>Liste des Blogs</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($blogs as $blog)
            <tr>
                <td>{{ $blog->title }}</td>
                <td>{{ $blog->status ? 'Actif' : 'Inactif' }}</td>
                <td>
                    <a href="{{ route('blogs.edit', $blog->blog_id) }}" class="btn btn-warning">Modifier</a>

                    <form action="{{ route('blogs.delete', $blog->blog_id) }}" method="POST" style="display:inline;">
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