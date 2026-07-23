@extends('layouts.app')
@section('content')

<div class="container">
    <h1>Modifier le Blog</h1>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('blogs.update', $blog->blog_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Titre:</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $blog->title) }}" required>
        </div>

        <div class="form-group">
            <label for="text">Texte:</label>
            <textarea name="text" id="text" class="form-control" rows="5" required>{{ old('text', $blog->text) }}</textarea>
        </div>

        <div class="form-group">
            <label for="url_media">URL Média:</label>
            <input type="file" name="url_media" id="url_media" class="form-control">
        </div>

        <div class="form-group">
            <label for="status">Statut:</label>
            <select name="status" id="status" class="form-control" required>
                <option value="1" {{ $blog->status == 1 ? 'selected' : '' }}>Actif</option>
                <option value="0" {{ $blog->status == 0 ? 'selected' : '' }}>Inactif</option>
            </select>
        </div>

        <div class="form-group">
            <label for="category_id">Catégorie:</label>
            <select name="category_id" id="category_id" class="form-control" required>
                @foreach($categories as $category)
                <option value="{{ $category->category_id }}" {{ $blog->category_id == $category->category_id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('mySpace') }}" class="btn btn-secondary">Retour</a>
    </form>

</div>
@endsection