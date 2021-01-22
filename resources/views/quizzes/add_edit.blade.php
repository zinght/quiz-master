@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <form action="{{$formurl}}" id="create_user_form" method="POST">
                    @csrf
                    @if($type == "edit")
                        <input type="hidden" value="{{$quiz->id}}" name="user_id" id="user_id">
                    @endif
                    <div class="card">
                        <div class="card-header">   @if($type == "add") Create Quiz @else Edit Quiz @endif</div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row my-3">

                                    <div class="col-md-6">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name" id="name" required value="@if($type == "edit") {{$quiz->name}} @else {{old('name')}} @endif">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="description">description</label>
                                        <input type="textarea" class="form-control" name="description" id="description" required value="@if($type == "edit") {{$quiz->description}} @else {{old('description')}} @endif">
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
                        <div class="card-footer justify-content-end d-flex">
                            <button type="submit" class="btn btn-success "> @if($type == "add") Create @else Edit @endif</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
