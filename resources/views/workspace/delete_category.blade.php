@if(session('delete_category_success'))
    <p class="success-message">{{ session('delete_category_success') }}</p>
@endif


<form id="delete-category-form" method="POST" action="{{ route('categories.destroy') }}" style="display: none;">
    @csrf
    @method('DELETE')
    <div class="form-group">
        <label id="text-delete-choice"  for="category-to-delete"><strong>Sélectionner la catégorie à supprimer</strong></label>
        <select id="category-to-delete" name="category_id" class="form-control" required>
            <option value="">Choisissez une catégorie</option>
            @foreach($categories as $category)
                <option value="{{ $category->category_id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="delete-category-btn">
        <button type="submit" class="btn btn-danger">Supprimer la catégorie</button>
    </div>
    

    <div>
        <a href="{{ route('mySpace') }}">Retour</a>
    </div>
</form>

