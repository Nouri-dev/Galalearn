<!-- resources/views/workspace/create_category.blade.php -->
@if(session('create_category_success'))
    <p class="success-message">{{ session('create_category_success') }}</p>
@endif

<form id="create-category-form" method="POST" action="{{ route('categories.store') }}" style="display: none;">
    @csrf
    <div class="form-group">
        <label for="category-name">Nom de la catégorie</label>
        <input type="text" id="category-name" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="category-parent">Catégorie parente (optionnelle)</label>
        <select id="category-parent" name="parent_category_id" class="form-control">
            <option value="">Aucune</option>
            @foreach($categories as $category)
                <option value="{{ $category->category_id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="create-category-btn">
        <button type="submit" class="btn btn-primary">Créer la catégorie</button>    
    </div>
    
    <div>
        <a href="{{ route('mySpace') }}">Retour</a>
    </div>
</form>















