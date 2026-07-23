<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Content;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        // si l'utilisateur est authentifié et si l'email n'est pas vérifié
        if (Auth::check() && !Auth::user()->email_verified) {
            // Ajouter un message d'erreur à la session
            session()->flash('error_email_verify', 'Votre adresse e-mail n\'a pas été vérifiée. Veuillez vérifier votre e-mail pour continuer.');
        }

        // Récupère toutes les catégories parent (où parent_category_id est null)
        $categories = Category::whereNull('parent_category_id')->get();
        // Récupère le dernier blog publié
        $latestBlog = Blog::latest()->first();
        // Récupérer les 3 derniers contenus
        $latestContents = Content::orderBy('created_at', 'desc')->take(3)->get();

        return view('index', compact('categories', 'latestBlog', 'latestContents'));
    }


    public function show($name)
    {
        // Rechercher la catégorie par le nom
        $category = Category::where('name', $name)->firstOrFail();

        // Récupérer les sous-catégories de cette catégorie
        $subCategories = Category::where('parent_category_id', $category->category_id)->get();
        // Passer les données à la vue
        return view('categories.show', compact('category', 'subCategories'));
    }



    public function showSubCategory($categoryId, $subCategoryId)
    {
        // Récupérer la catégorie principale
        $category = Category::findOrFail($categoryId);

        $subCategory = $category->subCategories()->with([
            'contents' => function ($query) {
                $query->select('content_id', 'title', 'category_id')->where('status', '!=', 0);
            },
            'quizzes' => function ($query) {
                $query->select('quiz_id', 'title', 'category_id')->where('status', '!=', 0);
            },
            'blogs' => function ($query) {
                $query->select('blog_id', 'title', 'category_id')->where('status', '!=', 0);
            },
        ])->findOrFail($subCategoryId);


        return view('categories.subcategory', compact('subCategory', 'category'));
    }


}
