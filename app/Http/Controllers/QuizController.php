<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuizRequest;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:administrator|user', 'permission:view_quizzes']);
        $this->middleware(['permission:view_quizzes']);
    }
    public function index()
    {
        $quizzes = Quiz::get();
        return view('quizzes.index', compact($quizzes));
    }

    public function create(Request $request)
    {
        $formurl = route('quizzes.submit_new_quiz');
        $type = 'add';
        return view('quizzes.add_edit', compact('formurl', 'type'));
    }

    public function submit_new_quiz(CreateQuizRequest $request)
    {


    }
}
