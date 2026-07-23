<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VerifyEmailController extends Controller
{
    public function verify(Request $request, $token)
    {
        // Récupérer l'utilisateur à partir de l'e-mail
        $user = User::where('email', $request->input('email'))->firstOrFail();

        // Vérifier si le token est valide
        if ($this->isValidToken($user, $token)) {
            // Marquer l'utilisateur comme vérifié
            $user->email_verified = true;
            $user->save();

            // Crée une entrée dans la table `students` pour l'utilisateur nouvellement inscrit
            Student::create(['user_id' => $user->user_id]);

            return redirect()->route('home')->with('message', 'Votre adresse e-mail a été vérifiée.');
        }

        return redirect()->route('home')->with('error', 'Le lien de vérification est invalide.');
    }

    private function isValidToken(User $user, $token)
    {
        // Comparez le token reçu avec celui encodé
        return true; 
    }
}
