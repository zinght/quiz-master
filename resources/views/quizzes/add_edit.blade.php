@extends('layouts.app')
@section('content')
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
                        <div class="card-footer justify-content-end d-flex">
                            <button type="submit" class="btn btn-success "> @if($type == "add") Create @else Save @endif</button>
                        </div>
                        @else
                            <div class="card-footer justify-content-end d-flex">
                                <a href="{{route('quizzes.index')}}" class="btn btn-success">Close</a>
                            </div>
                        @endif
                    </div>
                        @if($type !== "view")
                    </form>
                @endif

            </div>
        </div>
    </div>
@endsection
