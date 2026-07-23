<?php

namespace App\Http\Controllers;


use App\Models\Content;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ContentController extends Controller
{

    public function show($categoryId, $subCategoryId, $contentId)
    {
        // Récupérer la sous-catégorie spécifique
        $subCategory = Category::where('category_id', $subCategoryId)
            ->where('parent_category_id', $categoryId)
            ->firstOrFail();


        // Récupérer la catégorie spécifique
        $category = Category::where('category_id', $categoryId)
            ->firstOrFail();

        // Récupérer le contenu spécifique
        $content = Content::where('content_id', $contentId)
            ->where('category_id', $subCategoryId)
            ->firstOrFail();

             // Vérifier si le statut du Content est égal à 0
        if ($content->status == 0) {
            abort(404); 
        } 

        return view('contents.show', compact('content', 'subCategory', 'category'));
    }



    // Afficher la liste des contenus avec la possibilité de modifier ou de supprimer
    public function index()
    {
        $contents = Content::all();
        return view('workspace.index_content', compact('contents'));
    }

    // Gérer la suppression d'un contenu
    public function delete($id)
    {
        $content = Content::findOrFail($id);
        if ($content->url_media) {
            Storage::disk('public')->delete($content->url_media);
        }
    
        $content->delete();

        return redirect()->route('mySpace')->with('delete-content-success', 'Contenu supprimé avec succès.');
    }

    // Afficher le formulaire de modification d'un contenu
    public function edit($id)
    {
        $content = Content::findOrFail($id);
        $categories = Category::all();
        return view('workspace.edit_content', compact('content', 'categories'));
    }

    // Gérer la modification d'un contenu
    public function update(Request $request, $id)
    {
        $content = Content::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'url_media' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
            'category_id' => 'required|exists:categories,category_id',
        ]);

        // Mettre à jour les champs
        $content->title = $validated['title'];
        $content->text = $validated['text'];
        if ($request->hasFile('url_media')) {
            $path = $request->file('url_media')->store('media');
            $content->url_media = $path;
        }
        $content->status = $validated['status'];
        $content->category_id = $validated['category_id'];

        $content->updated_at = now();

        $content->save();

        return redirect()->route('mySpace')->with('edit-content-success', 'Contenu modifié avec succès.');
    }

    // Afficher le formulaire de création de contenu
    public function showCreateForm()
    {
        $categories = Category::all();
        return view('workspace.create_content', compact('categories'));
    }

    // Gérer la création d'un contenu
    public function createContent(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'url_media' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
            'category_id' => 'required|exists:categories,category_id',
        ]);

        $imagePath = null;
        if ($request->hasFile('url_media')) {
            $imagePath = $request->file('url_media')->store('media', 'public');
        }

        Content::create([
            'title' => $validated['title'],
            'text' => $validated['text'],
            'url_media' => $imagePath,
            'status' => $validated['status'],
            'user_id' => $user->user_id,
            'category_id' => $validated['category_id'],
        ]);

        return redirect()->route('mySpace')->with('content_create_success', 'Contenu créé avec succès.');
    }
}
