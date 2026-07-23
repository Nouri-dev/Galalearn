<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Afficher le formulaire de suppression
    public function showDeleteForm()
    {
        $comments = Comment::all(); 
        return view('workspace.delete_comment', compact('comments'));
    }

    // Gérer la suppression d'un commentaire
    public function deleteComment(Request $request)
    {
       
        $validated = $request->validate([
            'comment_id' => 'required|exists:comments,comment_id',
        ]);

        // Trouver et supprimer le commentaire
        $comment = Comment::findOrFail($validated['comment_id']);
        $comment->delete();

        return redirect()->route('mySpace')->with('delete_comment_success', 'Commentaire supprimé avec succès.');
    }
}
