<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreationRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role_or_permission:administrator|manage users']);
    }

    public function index(Request $request)
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }
    public function view(Request $request, User $user)
    {
        $type = "view";
        $user->load('quizzes');
        return view('users.add_edit', compact('type', 'user'));
    }
    public function delete_user(Request $request, User $user)
    {
        if(Auth::user()->id == $user->id)
        {
            $request->session()->flash('message', 'You cannot delete yourself');
            $request->session()->flash('alert-class', 'alert-danger');
            $data = collect(['type' => 'redirect', 'data' => route('users.index')]);
            return $data;
        }
        $user = User::findorfail($user->id);
        $delete_type = "User";
        $delete_title = $user->name;
        $formurl = route('users.submit_delete', [$user]);
        return view('includes.delete_modal', compact('user', 'delete_type', 'delete_title', 'formurl'));
    }

    public function submit_delete(Request $request, User $user)
    {
        $user = User::findorfail($user->id);
        $user->delete();
        $request->session()->flash('message', 'User Deleted!');
        $request->session()->flash('alert-class', 'alert-danger');
        return redirect()->route('users.index');

    }

    public function edit_user(Request $request, User $user)
    {
        $type = "edit";
        $user->load('quizzes');
        $formurl = route('users.submit_user');
        return view('users.add_edit', compact('type', 'formurl', 'user'));

    }

    public function create_user(Request $request)
    {
        $type = "add";
        $formurl = route('users.submit_new_user');
        return view('users.add_edit', compact('type', 'formurl'));
    }

    public function submit_new_user(UserCreationRequest $request)
    {
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password =  Hash::make($request->input('password'));
        $user->save();

        $request->session()->flash('message', 'User Created!');
        $request->session()->flash('alert-class', 'alert-success');

        return redirect()->route('users.index');
    }
    public function submit_user(UserEditRequest $request)
    {

        $user = User::findOrFail($request->input('user_id'));
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password =  Hash::make($request->input('password'));
        $user->save();

        $request->session()->flash('message', 'User Created!');
        $request->session()->flash('alert-class', 'alert-success');

        return redirect()->route('users.index');
    }
}
