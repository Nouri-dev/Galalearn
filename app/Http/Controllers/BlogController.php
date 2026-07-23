<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{

    public function show($categoryId, $subCategoryId, $blogId)
    {
        $subCategory = Category::where('category_id', $subCategoryId)
            ->where('parent_category_id', $categoryId)
            ->firstOrFail();

        $category = Category::where('category_id', $categoryId)
            ->firstOrFail();

        $blog = Blog::where('blog_id', $blogId)
            ->where('category_id', $subCategoryId)
            ->firstOrFail();


       
        if ($blog->status == 0) {
            abort(404); 
        } 


        //  les commentaires
        $comments = Comment::with('student.user')
            ->where('blog_id', $blogId)
            ->orderBy('created_at', 'desc')
            ->get();


        return view('blogs.show', compact('blog', 'subCategory', 'category', 'comments'));
    }



    public function storeComment(Request $request, $categoryId, $subCategoryId, $blogId)
    {
        
        $request->validate([
            'text' => 'required|string|max:1000',
        ]);

        Comment::create([
            'text' => $request->text,
            'user_id' => Auth::id(),
            'blog_id' => $blogId,
            'created_at' => now(),
        ]);


        return redirect()->route('blogs.show', [$categoryId, $subCategoryId, $blogId])
            ->with('success_comment_blog', 'Commentaire ajouté avec succès.');
    }






    // Afficher la liste des blogs avec la possibilité de modifier ou de supprimer
    public function index()
    {
        $blogs = Blog::all();
        return view('workspace.index_blog', compact('blogs'));
    }

    // Gérer la suppression d'un blog
    public function delete($id)
    {
        $blog = Blog::findOrFail($id);
        if ($blog->url_media) {
            Storage::disk('public')->delete($blog->url_media);
        }
        $blog->delete();

        return redirect()->route('mySpace')->with('delete-blog-success', 'Blog supprimé avec succès.');
    }

    // Afficher le formulaire de modification d'un blog
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $categories = Category::all();
        return view('workspace.edit_blog', compact('blog', 'categories'));
    }

    // Gérer la modification d'un blog
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'url_media' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
            'category_id' => 'required|exists:categories,category_id',
        ]);

        // Mettre à jour les champs
        $blog->title = $validated['title'];
        $blog->text = $validated['text'];
        if ($request->hasFile('url_media')) {
            $path = $request->file('url_media')->store('media');
            $blog->url_media = $path;
        }
        $blog->status = $validated['status'];
        $blog->category_id = $validated['category_id'];

        $blog->updated_at = now();

        $blog->save();

        return redirect()->route('mySpace')->with('edit-blog-success', 'Blog modifié avec succès.');
    }




    // Afficher le formulaire de création de blog
    public function showCreateForm()
    {
        $categories = Category::all();
        return view('workspace.create_blog', compact('categories'));
    }

    // Gérer la création d'un blog
    public function createBlog(Request $request)
    {
       
        $user = Auth::user();

        // Validation des données du blog
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'url_media' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
            'category_id' => 'required|exists:categories,category_id',
        ]);

        // Gérer l'upload de l'image
        $imagePath = null;
        if ($request->hasFile('url_media')) {
            $imagePath = $request->file('url_media')->store('media', 'public');
        }

        // Créer le blog
        Blog::create([
            'title' => $validated['title'],
            'text' => $validated['text'],
            'url_media' => $imagePath,  
            'status' => $validated['status'],
            'user_id' => $user->user_id,
            'category_id' => $validated['category_id'],
        ]);

        return redirect()->route('mySpace')->with('blog_create_success', 'Blog créé avec succès.');
    }
}
