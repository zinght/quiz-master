<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveNewQuestionRequest;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;

class QuizQuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:administrator', 'permission:edit quizzes'])->except('index');
    }
    public function view(Request $request, Quiz $quiz, $show = false)
    {
        $quiz->load('questions');
        return view ('quizzes.questions.view', compact('quiz'));
    }

    public function add(Request $request, Quiz $quiz)
    {
        $type = 'add';
        $formurl = route('quizzes.edit.questions.save', [$quiz]);
        return view ('quizzes.questions.add_edit_modal',compact('type', 'formurl'));
    }

    public function save(SaveNewQuestionRequest $request, Quiz $quiz)
    {
        $question = new QuizQuestion;
        $question->question = $request->input('question');
        $question->answer = $request->input('answer');
        $question->quiz_id = $quiz->id;
        $question->position = QuizQuestion::max('position') + 1;
        if($request->input('clue'))
        {
            $question->clue = $request->input('clue');
        }
        $question->save();

        $request->session()->flash('message', 'Quiz Question Created!');
        $request->session()->flash('alert-class', 'alert-success');
        return redirect()->route('quizzes.edit.edit', [$quiz, true]);

    }

}
