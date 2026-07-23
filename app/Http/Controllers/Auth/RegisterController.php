<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /**
     * Affiche le formulaire d'inscription.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        if (Auth::check()) {

            return redirect()->route('home');
        } else {

            return view('auth.register');
        }
    }

    /**
     * Gère la soumission du formulaire d'inscription.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Valide les données du formulaire
        $this->validator($request->all())->validate();

        // Crée l'utilisateur
        $this->create($request->all());

        // Redirige l'utilisateur vers la page d'accueil 
        return redirect()->route('home');
    }

    /**
     * Valide les données du formulaire.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:50', 'unique:users'],
            'lastname' => ['required', 'string', 'max:50'],
            'firstname' => ['required', 'string', 'max:50'],
            'birthdate' => ['required', 'date'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Crée un nouvel utilisateur après une validation réussie.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Crée l'utilisateur
        $user = User::create([
            'username' => $data['username'],
            'lastname' => $data['lastname'],
            'firstname' => $data['firstname'],
            'birthdate' => $data['birthdate'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'email_verified' => false,
            'status' => true, 
        ]);
        // Générer un token unique
        $token = Str::random(60);

        // Envoyer l'e-mail de vérification avec le lien contenant le token
        Mail::send('emails.verify', ['user' => $user, 'token' => $token], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Vérifiez votre adresse e-mail');
        });

        return $user;
    }
}
