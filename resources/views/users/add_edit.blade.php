@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{$formurl}}" id="create_user_form" method="POST">
                    @csrf
                    @if($type == "edit")
                        <input type="hidden" value="{{$user->id}}" name="user_id" id="user_id">
                    @endif
                    <div class="card">
                        <div class="card-header">   @if($type == "add") Create User @else Edit User @endif</div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row my-3">

                                    <div class="col-md-6">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name" id="name" required value="@if($type == "edit") {{$user->name}} @else {{old('name')}} @endif">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" required value="@if($type == "edit") {{$user->email}} @else {{old('email')}} @endif">
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-md-6">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" required >
                                    </div>
                                    <div class="col-md-6">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success"> @if($type == "add") Create @else Edit @endif</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
