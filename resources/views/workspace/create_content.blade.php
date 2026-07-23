@if(session('content_create_success'))
<div class="alert alert-success">
    {{ session('content_create_success') }}
</div>
@endif

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form id="create-content-form" action="{{ route('contents.create') }}" method="POST" enctype="multipart/form-data" style="display: none;">
    @csrf
    <div class="form-group">
        <label for="title">Titre du contenu:</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
    </div>

    <div class="form-group">
        <label for="text">Texte:</label>
        <textarea name="text" id="text" class="form-control" rows="5" required>{{ old('text') }}</textarea>
    </div>

    <div class="form-group">
        <label for="url_media">Image Média:</label>
        <input type="file" name="url_media" id="url_media" class="form-control">
    </div>

    <div class="form-group">
        <label for="status">Statut:</label>
        <select name="status" id="status" class="form-control" required>
            <option value="1">Actif</option>
            <option value="0">Inactif</option>
        </select>
    </div>

    <div class="form-group">
        <label for="category_id">Catégorie:</label>
        <select name="category_id" id="category_id" class="form-control" required>
            @foreach($categories as $category)
                <option value="{{ $category->category_id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Créer</button>

    <div>
        <a href="{{ route('mySpace') }}">Retour</a>
    </div>
</form>