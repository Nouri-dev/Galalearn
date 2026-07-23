<?php
namespace App\Http\Controllers\WorkSpace;

use App\Models\Blog;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Result;
use App\Models\Comment;
use App\Models\Content;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MySpaceController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        $categories = Category::all();
        $users = User::all(); 
        $comments = Comment::all();
        $quizzes = Quiz::all();
        $blogs = Blog::all();
        $contents = Content::all();
        $results = Result::all();

        // Récupérer l'utilisateur connecté
        $user = Auth::user(); 

        return view('workspace.mySpace', compact('categories', 'users', 'comments', 'quizzes', 'blogs', 'contents', 'results', 'user'));
    }
}

