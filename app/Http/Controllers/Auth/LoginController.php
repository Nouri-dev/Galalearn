<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {

            return redirect()->route('home');
            
        }else{

           return view('auth.login');
           
        }

        
    }

    public function login(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Récupérer les informations d'identification du formulaire
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            Auth::user();
            return redirect()->intended('/');
        }

        // Authentification échouée
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        // Déconnecter l'utilisateur
        Auth::logout();
        
        // Rediriger vers la page de connexion
        return redirect('/');
    }
}
