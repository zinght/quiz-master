<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuizRequest;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Telescope\Watchers\QueryWatcher;

class QuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:administrator|user', 'permission:view quizzes']);
    }
    public function index()
    {
        $quizzes = Quiz::with('createdby')->get();
        return view('quizzes.index', compact('quizzes'));
    }

    public function create(Request $request)
    {
        $formurl = route('quizzes.submit_new_quiz');
        $type = 'add';
        return view('quizzes.add_edit', compact('formurl', 'type'));
    }

    public function submit_new_quiz(CreateQuizRequest $request)
    {
        $quiz = new Quiz;
        $quiz->name = $request->input('name');
        $quiz->description = $request->input('description');
        $quiz->created_by = Auth::user()->id;
        $quiz->save();
        $request->session()->flash('message', 'User Created!');
        $request->session()->flash('alert-class', 'alert-success');
        return redirect()->route('quizzes.index');
    }

    public function submit(CreateQuizRequest $request)
    {
        $quiz = Quiz::findorfail($request->input('quiz_id'));
        $quiz->name = $request->input('name');
        $quiz->description = $request->input('description');
        $quiz->created_by = Auth::user()->id;
        $quiz->save();

        $request->session()->flash('message', 'Quiz Updated!');
        $request->session()->flash('alert-class', 'alert-success');
        return redirect()->route('quizzes.index');
    }

    public function view(Request $request, Quiz $quiz)
    {
        $type = 'view';
        $quiz->load('questions');
        return view('quizzes.add_edit', compact( 'quiz', 'type'));
    }

    public function edit(Request $request, Quiz $quiz, $show = false)
    {
        $type = 'edit';
        $quiz->load('questions');
        $formurl = route('quizzes.submit');
        return view('quizzes.add_edit', compact( 'quiz', 'type', 'formurl', 'show'));
    }

    public function delete(Request $request, Quiz $quiz)
    {

        $model = Quiz::findorfail($quiz->id);
        $delete_type = "Quiz";
        $delete_title = $model->name;
        $formurl = route('quizzes.submit_delete', [$model]);
        return view('includes.delete_modal', compact('model', 'delete_type', 'delete_title', 'formurl'));

    }

    public function submit_delete(Request $request, Quiz $quiz)
    {
        $quiz = Quiz::findorfail($quiz->id);
        $quiz->delete();
        $request->session()->flash('message', 'Quiz Deleted!');
        $request->session()->flash('alert-class', 'alert-danger');
        return redirect()->route('quizzes.index');

    }
}
