<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\WorkSpace\MySpaceController;



// Routes pour la page d'accueil
Route::get('/', [IndexController::class, 'index'])->name('home');
// Routes pour email de comfirmation
Route::get('/verify-email/{token}', [VerifyEmailController::class, 'verify'])->name('verify.email');


// Routes pour l'inscription
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Routes pour la connexion
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Route pour la déconnexion
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');






// Routes pour Workspace
Route::get('/my-space', [MySpaceController::class, 'index'])
     ->name('mySpace')
     ->middleware('auth');

// Routes pour la gestion des catégories
Route::get('/workspace/create_category', function () {
     $categories = \App\Models\Category::all();
     return view('workspace.create_category', compact('categories'));
})->middleware('auth');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

Route::get('/workspace/delete_category', function () {
     $categories = \App\Models\Category::all();
     return view('workspace.delete_category', compact('categories'));
})->middleware('auth');
Route::delete('/categories', [CategoryController::class, 'destroy'])->name('categories.destroy');

// Routes pour la gestion des utilisateurs
Route::get('/workspace/index_user', [UserController::class, 'showProfile'])
     ->name('users.profile')
     ->middleware('auth');


Route::get('/workspace/delete_user', [UserController::class, 'showDeleteForm'])
     ->middleware('auth');
Route::delete('/users/delete', [UserController::class, 'deleteUser'])
     ->name('users.delete')
     ->middleware('auth');

Route::get('/workspace/add_role_user', [UserController::class, 'showAddRoleForm'])
     ->middleware('auth');
Route::post('/users/add_role_user', [UserController::class, 'addUserToRole'])
     ->name('users.addRole');

Route::get('/workspace/remove_role_user', [UserController::class, 'showRemoveRoleForm'])
     ->middleware('auth');
Route::post('/users/remove_role_user', [UserController::class, 'removeUserFromRole'])
     ->name('users.removeRole');

// Routes pour la gestion des commentaires
Route::get('/workspace/delete_comment', [CommentController::class, 'showDeleteForm'])
     ->middleware('auth');
Route::delete('/comments/delete', [CommentController::class, 'deleteComment'])
     ->name('comments.delete')
     ->middleware('auth');

// Routes pour les quiz
Route::get('/workspace/create_quiz', [QuizController::class, 'showCreateForm'])->name('quizzes.createForm');
Route::post('/quiz/create', [QuizController::class, 'createQuiz'])->name('quizzes.create');
Route::get('/workspace/index_quiz', [QuizController::class, 'index'])->name('quizzes.index');
Route::get('/quiz/edit/{id}', [QuizController::class, 'edit'])->name('quizzes.edit');
Route::put('/quiz/update/{id}', [QuizController::class, 'update'])->name('quizzes.update');
Route::delete('/quiz/delete/{id}', [QuizController::class, 'deleteQuiz'])->name('quizzes.delete');

// Routes pour les contenus
Route::get('/workspace/create_content', [ContentController::class, 'showCreateForm'])->name('contents.showCreateForm')
     ->middleware('instructor');
Route::post('/contents/create', [ContentController::class, 'createContent'])->name('contents.create');
Route::get('/workspace/index_content', [ContentController::class, 'index'])->name('contents.index');
Route::delete('/contents/{id}', [ContentController::class, 'delete'])->name('contents.delete');
Route::get('/contents/{id}/edit', [ContentController::class, 'edit'])->name('contents.edit');
Route::put('/contents/{id}', [ContentController::class, 'update'])->name('contents.update');

// Routes pour les blogs
Route::get('/workspace/create_blog', [BlogController::class, 'showCreateForm'])
     ->name('blogs.showCreateForm');
Route::post('/blogs/create', [BlogController::class, 'createBlog'])
     ->name('blogs.create');
Route::get('/workspace/index_blog', [BlogController::class, 'index'])->name('blogs.index');
Route::delete('/blogs/{id}', [BlogController::class, 'delete'])->name('blogs.delete');
Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
Route::put('/blogs/{id}', [BlogController::class, 'update'])->name('blogs.update');

// Routes pour les résultats
Route::get('/workspace/index_result', [ResultController::class, 'index'])
     ->name('results.index')
     ->middleware('student');





// Route générique pour les catégories
Route::get('/categories/{categoryId}', [IndexController::class, 'show'])->name('categories.show');


// Route pour afficher une sous-catégorie spécifique 
Route::get('/categories/{categoryId}/subcategories/{subCategoryId}', [IndexController::class, 'showSubCategory'])
     ->name('categories.showSubCategory');

// Route pour afficher un contents spécifique dans une sous-catégorie
Route::get('/categories/{categoryId}/subcategories/{subCategoryId}/contents/{content_id}', [ContentController::class, 'show'])
     ->name('contents.show')
     ->middleware('student');;

// Route pour afficher un quiz spécifique dans une sous-catégorie
Route::get('/categories/{categoryId}/subcategories/{subCategoryId}/quizzes/{quiz_id}', [QuizController::class, 'show'])
     ->name('quizzes.show')
     ->middleware('auth');

// Route pour soumettre les réponses du quiz
Route::post('/categories/{categoryId}/subcategories/{subCategoryId}/quizzes/{quizId}/submit', [QuizController::class, 'submit'])
     ->name('quizzes.submit')
     ->middleware('auth');;


// Route pour affiché le resutat du quizz
Route::get('/categories/{categoryId}/subcategories/{subCategoryId}/quizzes/{quizId}/result-quizz', [QuizController::class, 'showQuizzResult'])
     ->name('quizzes.show_quizz_result')
     ->middleware('auth');;



// Route pour afficher un blog spécifique dans une sous-catégorie
Route::get('/categories/{categoryId}/subcategories/{subCategoryId}/blogs/{blog_id}', [BlogController::class, 'show'])
     ->name('blogs.show');

// Route pour ajouter un commentaire au blog
Route::post('/categories/{categoryId}/subcategories/{subCategoryId}/blogs/{blog_id}/comments', [BlogController::class, 'storeComment'])
     ->name('comments.store');
