<?php 


namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    


    public function store(Request $request)
    {
        $user = Auth::user(); 

        // Validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'parent_category_id' => 'nullable|exists:categories,category_id',
        ]);

        // Associer l'utilisateur connecté 
        $validated['user_id'] = $user->user_id;

       

        Category::create($validated);

        return redirect()->route('mySpace')->with('create_category_success', 'Catégorie créée avec succès');
    }


    public function destroy(Request $request)
    {
      
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,category_id',
        ]);

        // Trouver et supprimer la catégorie
        $category = Category::findOrFail($validated['category_id']);
        $category->delete();

        return redirect()->route('mySpace')->with('delete_category_success', 'Catégorie supprimée avec succès');
    }






}
