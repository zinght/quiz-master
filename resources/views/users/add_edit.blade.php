@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                @if($type !== 'view')
                    <form action="{{$formurl}}" id="create_user_form" method="POST">
                        @csrf
                @endif

                    @if($type == "edit")
                        <input type="hidden" value="{{$user->id}}" name="user_id" id="user_id">
                    @endif
                    <div class="card">
                        <div @if($type == "view") class="card-header justify-content-between d-flex" @endif class="card-header ">

                            @if($type == "add") Create User @elseif($type == "edit") Edit @else View @endif User
                                @if($type == "view") <a href="{{route('users.edit', [$user])}}" class="btn btn-success btn-sm mx-4">Edit</a> @endif

                          </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row my-3">

                                    <div class="col-md-6">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control"   @if($type == "view") disabled @endif name="name" id="name" required value="@if($type == "edit" || $type == "view") {{$user->name}} @else {{old('name')}} @endif">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control"   @if($type == "view") disabled @endif name="email" id="email" required value="@if($type == "edit" || $type == "view") {{$user->email}} @else {{old('email')}} @endif">
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-md-6">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" @if($type == "view") disabled @endif id="password" required >
                                    </div>
                                    <div class="col-md-6">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation" @if($type == "view") disabled @endif id="password_confirmation" required >
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
                        <div  @if($type == "view") class="card-footer d-flex justify-content-between" @else class="card-footer d-flex " @endif>
                            @if($type == "view")
                                <button  class="btn btn-primary btn-info btn-sm text-light view_questions">View Questions</button>
                                <button  class="btn btn-primary btn-info btn-sm text-light hide_questions d-none">Hide Questions</button>
                            <div>

                                <a href="{{route('users.index')}}" class="btn btn-primary btn-sm">Close</a>
                            </div>

                            @else
                                <button type="submit" class="btn btn-success btn-sm"> @if($type == "add") Create @else Save @endif</button>
                            @endif
                        </div>
                    </div>
                    @if($type !== 'view')
                        </form>
                    @endif


            </div>
        </div>
        @if($type == "view")
            <div class="row quiz_section justify-content-center mt-4 d-none">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            {{$user->name}}'s Quizzes
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    @if(optional($user->quizzes)->count() > 0)
                                        <div class="table-responsive mt-2" style="overflow-y: hidden">
                                            <table class="table table table-sm h-100">
                                                <thead>
                                                <tr>
                                                    <th>id</th>
                                                    <th>Name</th>
                                                    <th>Created At</th>
                                                    <th></th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                @foreach($user->quizzes as $quiz)
                                                    <tr>
                                                        <td>{{$quiz->id}}</td>
                                                        <td>{{$quiz->name}}</td>
                                                        <td>{{$quiz->created_at_date_display}}</td>
                                                        <td><a class="btn btn-success btn-sm " href="{{route('quizzes.view', [$quiz])}}">View</a></td>
                                                    </tr>
                                                @endforeach

                                                </tbody>


                                            </table>
                                        </div>
                                    @else
                                        <div class="alert alert-info">
                                            No Questions Found
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        @endif
    </div>
@endsection
@section('javascript')
    <script>
        $( document ).ready(function() {
            $('.view_questions').on('click', function(e) {
               $('.hide_questions').removeClass('d-none');
               $(this).addClass('d-none');
               $('.quiz_section').removeClass('d-none');
            });
            $('.hide_questions').on('click', function(e) {
                $('.view_questions').removeClass('d-none');
                $(this).addClass('d-none');
                $('.quiz_section').addClass('d-none');
            });
        });
    </script>
@endsection
