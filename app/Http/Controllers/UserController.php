<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Instructor;
use Illuminate\Http\Request;
use App\Models\Administrator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showProfile()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour voir votre profil.');
        }

        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Passer les informations de l'utilisateur à la vue
        return view('workspace.index_user', ['user' => $user]);
    }
    
    


    // Afficher le formulaire de suppression
    public function showDeleteForm()
    {
        $users = User::all(); 
        return view('workspace.delete_user', compact('users'));
    }

    // Gérer la suppression d'un utilisateur
    public function deleteUser(Request $request)
    {
       
        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id',
        ]);

        // Trouver et supprimer l'utilisateur
        $user = User::findOrFail($validated['user_id']);
        $user->delete();

        // Redirection après la suppression
        return redirect()->route('mySpace')->with('delete_user_success', 'Utilisateur supprimé avec succès.');
    }




    // Afficher le formulaire ajout role user
    public function showAddRoleForm()
    {
        $users = User::all(); 
        return view('workspace.add_role_user', compact('users')); 
    }

    // Afficher le formulaire de suppression role user
    public function showRemoveRoleForm()
    {
        $users = User::all(); 
        return view('workspace.remove_role_user', compact('users')); 
    }



    public function addUserToRole(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'role' => 'required|in:student,administrator,instructor',
        ]);

        $user = User::findOrFail($validated['user_id']);
        $role = $validated['role'];

        // Vérifier si l'utilisateur a déjà ce rôle
        if ($this->isUserInRole($user->user_id, $role)) {
            return redirect()->back()->with('role_assignment_user_error', 'Cet utilisateur a déjà le rôle ' . ucfirst($role) . '.');
        }

        switch ($role) {
            case 'student':
                Student::create(['user_id' => $user->user_id]);
                break;
            case 'administrator':
                Administrator::create(['user_id' => $user->user_id]);
                break;
            case 'instructor':
                Instructor::create(['user_id' => $user->user_id]);
                break;
            default:
                return redirect()->back()->with('create_invalide_role_user_error', 'Rôle invalide.');
        }

        return redirect()->route('mySpace')->with('role_user_create_success', ucfirst($role) . ' Rôle ajouté avec succès.');
    }

    public function removeUserFromRole(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'role' => 'required|in:student,administrator,instructor',
        ]);

        $role = $validated['role'];
        $user = User::findOrFail($validated['user_id']);

        if (!$this->canUserBeRemoved($user->user_id)) {
            return redirect()->back()->with('minimum_role_user_error', 'Cet utilisateur doit avoir au moins un rôle.');
        }

        switch ($role) {
            case 'student':
                Student::where('user_id', $user->user_id)->delete();
                break;
            case 'administrator':
                Administrator::where('user_id', $user->user_id)->delete();
                break;
            case 'instructor':
                Instructor::where('user_id', $user->user_id)->delete();
                break;
            default:
                return redirect()->back()->with('delete_invalide_role_user_error', 'Rôle invalide.');
        }

        return redirect()->route('mySpace')->with('role_user_delete_success', ucfirst($role) . ' Rôle supprimé avec succès.');
    }


    private function isUserInRole($userId, $role)
    {
        switch ($role) {
            case 'student':
                return Student::where('user_id', $userId)->exists();
            case 'administrator':
                return Administrator::where('user_id', $userId)->exists();
            case 'instructor':
                return Instructor::where('user_id', $userId)->exists();
            default:
                return false;
        }
    }

    private function canUserBeRemoved($userId)
    {
        $rolesCount = 0;

        if (Student::where('user_id', $userId)->exists()) $rolesCount++;
        if (Administrator::where('user_id', $userId)->exists()) $rolesCount++;
        if (Instructor::where('user_id', $userId)->exists()) $rolesCount++;

        return $rolesCount > 1; 
    }
}
