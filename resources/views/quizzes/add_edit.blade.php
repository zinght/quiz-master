@extends('layouts.app')
@section('content')
    <input type="hidden" id="shown" name="show" value="{{$show}}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                @if($type !== "view")
                    <form action="{{$formurl}}" id="create_user_form" method="POST">
                    @csrf
                    @if($type == "edit")
                        <input type="hidden" value="{{$quiz->id}}" name="quiz_id" id="quiz_id">
                    @endif
                @endif

                    <div class="card">
                        <div class="card-header">  @if($type == "add") Create Quiz @elseif($type == 'edit') Edit Quiz @else View Quiz @endif</div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row my-3">

                                    <div class="col-md-6">
                                        <label for="name" @if($type == "view") disabled @endif>Name</label>
                                        <input type="text" @if($type == "view") disabled @endif class="form-control" name="name" id="name" required value="@if(in_array($type, ["edit", "view"])) {{$quiz->name}} @else {{old('name')}} @endif">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="description">description</label>
                                        <textarea rows="1" cols="50" wrap="physical"  type="text" class="form-control" maxlength="255" name="description" id="description" required  @if($type == "view") disabled @endif>@if($type == "edit"){{$quiz->description}}@else{{old('description')}}@endif</textarea>
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
                        @if($type !== "view")
                        <div class="card-footer justify-content-between d-flex">
                            @if($quiz && Auth::user()->can('view quiz questions'))
                                <button data-url="{{route('quizzes.edit.questions.view', [$quiz])}}" class="btn btn-primary btn-sm" type="button" id="view_questions">View Questions</button>
                                <button class="btn btn-primary btn-sm d-none" type="button" id="hide_questions">Hide Questions</button>
                                <button data-url="{{route('quizzes.edit.questions.add', [$quiz])}}" class="btn btn-primary btn-sm d-none" type="button" id="add_question">Add Question</button>
                            @endif
                            <button type="submit" class="btn btn-success  btn-sm"> @if($type == "add") Create @else Save @endif</button>
                        </div>
                        @else
                            <div class="card-footer justify-content-between d-flex">
                                @if($quiz && Auth::user()->can('view quiz questions'))
                                    <button data-url="{{route('quizzes.edit.questions.view', [$quiz])}}" class="btn btn-primary btn-sm " type="button" id="view_questions">View Questions</button>
                                    <button class="btn btn-primary btn-sm d-none" type="button" id="hide_questions"></button>
                                    <button data-url="{{route('quizzes.edit.questions.add', [$quiz])}}" class="btn btn-primary btn-sm d-none" type="button" id="add_question">Add Question</button>
                                @endif
                                <a href="{{route('quizzes.index')}}" class="btn btn-success">Close</a>
                            </div>
                        @endif
                    </div>
                @if($type !== "view")
                    </form>
                @endif
            </div>

        </div>
        @if($quiz && Auth::user()->can('view quiz questions'))
            <div class="row questions_area justify-content-center mt-4">

            </div>
            <div class="modal_area">

            </div>
        @endif

    </div>

@endsection
@section('javascript')
    <script>
        $( document ).ready(function() {
            if($('#shown').val() == true)
            {
                $('#add_question').removeClass('d-none');
                $('#hide_questions').removeClass('d-none');
                $('view_questions').addClass('d-none');
                let url = $('#view_questions').data('url');
                $.ajax({
                    /* the route pointing to the post function */
                    url: url,
                    type: 'get',
                    success: function (data) {
                        $(".questions_area").html(data);
                    }
                });
            }
           $('#view_questions').on('click', function(e){
               $('#add_question').removeClass('d-none');
               $('#hide_questions').removeClass('d-none');
               $(this).addClass('d-none');
               let url = $(this).data('url');
               $.ajax({
                   /* the route pointing to the post function */
                   url: url,
                   type: 'get',
                   success: function (data) {
                       $(".questions_area").html(data);
                   }
               });
           })
            $('#hide_questions').on('click', function(e){
                $('#view_questions').removeClass('d-none');
                $('#add_question').addClass('d-none');
                $(this).addClass('d-none');
                $('.questions_area').html('');
            });
            $('#add_question').on('click', function(e){
                let url = $(this).data('url');
                $.ajax({
                    /* the route pointing to the post function */
                    url: url,
                    type: 'get',
                    success: function (data) {
                        $(".modal_area").html(data);
                        $('#add_question_modal').modal('show');
                    }
                });
            });
        });
    </script>
@endsection
