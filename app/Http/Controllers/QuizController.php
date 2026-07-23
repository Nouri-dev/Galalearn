<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Result;
use App\Models\Category;
use App\Models\Question;
use App\Models\Response;
use Illuminate\Http\Request;
use App\Models\StudentAnswer;
use Illuminate\Support\Facades\Auth;


class QuizController extends Controller
{


    public function show($categoryId, $subCategoryId, $quizId)
    {
        // Récupérer la catégorie parente
        $category = Category::findOrFail($categoryId);

        // Récupérer la sous-catégorie spécifique
        $subCategory = Category::where('category_id', $subCategoryId)
            ->where('parent_category_id', $categoryId)
            ->firstOrFail();

        // Récupérer le quiz avec ses questions et réponses associées
        $quiz = Quiz::with(['questions.responses'])
            ->where('quiz_id', $quizId)
            ->where('category_id', $subCategoryId)
            ->firstOrFail();

        // Vérifier si le statut du Quiz est égal à 0
        if ($quiz->status == 0) {
            abort(404); 
        }

        // Passer la catégorie, la sous-catégorie et le quiz à la vue
        return view('quizzes.show', compact('category', 'subCategory', 'quiz'));
    }




    public function showQuizzResult($categoryId, $subCategoryId, $quizId)
    {
        $user = Auth::user();


        // Récupérer le quiz et le résultat du quiz
        $quiz = Quiz::findOrFail($quizId);

         // Vérifier si le statut du quiz est égal à 0
         if ($quiz->status == 0) {
            abort(404); 
        }

        $result = Result::where('user_id', $user->user_id)
            ->where('quiz_id', $quizId)
            ->firstOrFail();


        // Passer les données à la vue
        return view('quizzes.show_quizz_result', [
            'quiz' => $quiz, // Passe l'objet quiz
            'score' => $result->score,
            'categoryId' => $categoryId,
            'subCategoryId' => $subCategoryId,
            'quizId' => $quizId,
        ]);
    }




    protected function getFirstCompletionDate($userId)
    {
        // Récupérer le premier résultat pour l'utilisateur pour obtenir la date de completion
        $firstResult = Result::where('user_id', $userId)
            ->orderBy('date_completed', 'asc')
            ->first();

        return $firstResult ? $firstResult->date_completed : null;
    }



    protected function clearExistingData($userId, $quizId)
    {
        // Vider les réponses de l'utilisateur pour ce quiz
        StudentAnswer::where('user_id', $userId)
            ->where('quiz_id', $quizId)
            ->delete();

        // Vider les résultats de l'utilisateur pour ce quiz
        Result::where('user_id', $userId)
            ->where('quiz_id', $quizId)
            ->delete();
    }




    public function submit(Request $request, $categoryId, $subCategoryId, $quizId)
    {
        $user = Auth::user();

        // Récupérer la date de completion précédente
        $firstCompletionDate = $this->getFirstCompletionDate($user->user_id);

        // Récupérer le quiz spécifique
        $quiz = Quiz::with('questions.responses')
            ->where('quiz_id', $quizId)
            ->where('category_id', $subCategoryId)
            ->firstOrFail();

        // Vider les données existantes
        $this->clearExistingData($user->user_id, $quiz->quiz_id);

        // Initialiser le score
        $score = 0;
        $totalQuestions = $quiz->questions->count(); 

        // Validation des réponses
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'array',
            'answers.*.*' => 'required|integer|exists:responses,response_id',
        ]);

        // Boucler sur les questions pour vérifier les réponses
        foreach ($quiz->questions as $question) {
            if (isset($request->answers[$question->question_id])) {
                $responseIds = $request->answers[$question->question_id];

                // Enregistrer les réponses
                foreach ($responseIds as $responseId) {
                    StudentAnswer::create([
                        'user_id' => $user->user_id,
                        'quiz_id' => $quiz->quiz_id,
                        'question_id' => $question->question_id,
                        'response_id' => (int) $responseId,
                        'created_at' => now(),
                    ]);
                }

                // Vérifier les réponses correctes et calculer le score
                $correctResponses = $question->responses->where('is_correct', 1)->pluck('response_id')->toArray();
                $score += $this->calculateQuestionScore($correctResponses, $responseIds, $totalQuestions);
            }
        }

        // Enregistrer ou mettre à jour le résultat avec la date de completion précédente
        Result::updateOrCreate(
            ['user_id' => $user->user_id, 'quiz_id' => $quiz->quiz_id],
            [
                'score' => $score,
                'date_completed' => $firstCompletionDate ?? now(),
                'updated_at' => now()
            ]
        );

        // Redirection après soumission
        return redirect()->route('quizzes.show_quizz_result', [$categoryId, $subCategoryId, $quizId]);
    }





    private function calculateQuestionScore(array $correctResponses, array $userResponses, int $totalQuestions)
    {
        $totalCorrectResponses = count($correctResponses);
        $userCorrectResponses = count(array_intersect($userResponses, $correctResponses));
        $userIncorrectResponses = count(array_diff($userResponses, $correctResponses));

        // Calculer le score pour la question
        if ($userCorrectResponses > 0 && $userIncorrectResponses === 0) {
            // Toutes les réponses sélectionnées sont correctes
            return 100 / $totalQuestions; // Plein score pour cette question
        } elseif ($userCorrectResponses > 0 && $userIncorrectResponses > 0) {
            // Mélange de réponses correctes et incorrectes
            return 50 / $totalQuestions; // La moitié du score pour cette question
        }

        // Si toutes les réponses sont incorrectes ou si aucune réponse correcte n'est sélectionnée
        return 0;
    }





    // Afficher le formulaire de création de quiz
    public function showCreateForm()
    {
        $categories = Category::all();
        return view('workspace.create_quiz', compact('categories'));
    }



    
    // Gérer la création d'un quiz
    public function createQuiz(Request $request)
    {
        $user = Auth::user();

        // Validation des données du quiz, des questions, et des réponses
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|boolean',
            'category_id' => 'required|exists:categories,category_id',
            'questions' => 'required|array',
            'questions.*.text' => 'required|string|max:1000',
            'questions.*.responses' => 'required|array|min:2', 
            'questions.*.responses.*.text' => 'required|string|max:1000',
            'questions.*.responses.*.is_correct' => 'nullable|boolean',
        ]);

        // Vérifier qu'au moins une réponse est correcte pour chaque question
        $questions = $validated['questions'];
        foreach ($questions as $questionData) {
            $hasCorrectAnswer = false;
            foreach ($questionData['responses'] as $responseData) {
                if ($responseData['is_correct'] == '1') {
                    $hasCorrectAnswer = true;
                    break;
                }
            }
            if (!$hasCorrectAnswer) {
                return redirect()->back()->withInput()->withErrors([
                    'questions' => 'Chaque question doit avoir au moins une réponse correcte.'
                ]);
            }
        }

        // Créer le quiz
        $quiz = Quiz::create([
            'title' => $validated['title'],
            'status' => $validated['status'],
            'category_id' => $validated['category_id'],
            'user_id' => $user->user_id,
        ]);

        // Créer les questions et les réponses associées
        foreach ($validated['questions'] as $questionData) {
            $question = Question::create([
                'quiz_id' => $quiz->quiz_id,
                'text' => $questionData['text'],
                'user_id' => $user->user_id,
            ]);

            foreach ($questionData['responses'] as $responseData) {
                Response::create([
                    'quiz_id' => $quiz->quiz_id,
                    'question_id' => $question->question_id,
                    'text' => $responseData['text'],
                    'is_correct' => $responseData['is_correct'] ?? 0,
                    'user_id' => $user->user_id,
                ]);
            }
        }

       
        return redirect()->route('mySpace')->with('quiz_create_success', 'Quiz, questions et réponses créés avec succès.');
    }



    // Afficher la liste des quizzes avec la possibilité de modifier ou de supprimer
    public function index()
    {
        $quizzes = Quiz::all();
        return view('workspace.index_quiz', compact('quizzes'));
    }



    // Afficher le formulaire de modification d'un quiz
    public function edit($id)
    {
        $quiz = Quiz::findOrFail($id);
        $categories = Category::all();
        return view('workspace.edit_quiz', compact('quiz', 'categories'));
    }



    // Gérer la modification d'un quiz
    public function update(Request $request, $id)
    {
        // Validation des données du formulaire
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|boolean',
            'category_id' => 'required|exists:categories,category_id',
            'questions' => 'required|array',
            'questions.*.id' => 'nullable|exists:questions,question_id', 
            'questions.*.text' => 'required|string|max:1000',
            'questions.*.responses' => 'required|array|min:2',
            'questions.*.responses.*.id' => 'nullable|exists:responses,response_id', 
            'questions.*.responses.*.text' => 'required|string|max:1000',
            'questions.*.responses.*.is_correct' => 'nullable|boolean',
        ]);

        // Trouver et mettre à jour le quiz
        $quiz = Quiz::findOrFail($id);
        $quiz->title = $validated['title'];
        $quiz->status = $validated['status'];
        $quiz->category_id = $validated['category_id'];
        $quiz->save();

        // Mettre à jour les questions et les réponses
        foreach ($validated['questions'] as $i => $questionData) {
            // Trouver la question existante ou en créer une nouvelle si elle n'existe pas
            $question = Question::find($questionData['id']);
            if (!$question) {
                // Si la question n'existe pas, on continue avec la prochaine
                continue;
            }
            $question->text = $questionData['text'];
            $question->save();

            // Mettre à jour les réponses
            foreach ($questionData['responses'] as $j => $responseData) {
                if (isset($responseData['id'])) {
                    // Mettre à jour une réponse existante
                    $response = Response::find($responseData['id']);
                    if ($response) {
                        $response->text = $responseData['text'];
                        $response->is_correct = $responseData['is_correct'] ?? 0;
                        $response->save();
                    }
                } else {
                    // Ajouter une nouvelle réponse (si des IDs ne sont pas fournis)
                    Response::create([
                        'question_id' => $question->question_id,
                        'text' => $responseData['text'],
                        'is_correct' => $responseData['is_correct'] ?? 0,
                    ]);
                }
            }
        }

        // Redirection après la mise à jour
        return redirect()->route('mySpace')->with('edit-quiz-success', 'Quiz modifié avec succès.');
    }



    // Gérer la suppression d'un quiz
    public function deleteQuiz($id)
    {
        $quiz = Quiz::findOrFail($id);

        // Supprimer les questions et réponses associées
        foreach ($quiz->questions as $question) {
            $question->responses()->delete();
            $question->delete();
        }

        // Supprimer le quiz
        $quiz->delete();

        return redirect()->route('mySpace')->with('delete-quiz-success', 'Quiz supprimé avec succès.');
    }
}
