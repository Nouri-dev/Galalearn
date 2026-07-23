<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{



    public function index()
    {
       if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour voir vos résultats.');
        } 

        // Récupérer l'ID de l'utilisateur connecté
        $userId = Auth::id();

        // Récupérer les résultats de l'utilisateur connecté
        $results = Result::where('user_id', $userId)->get();

        // Passer les résultats à la vue
        return view('workspace.index_result', ['results' => $results]);
    }



}
