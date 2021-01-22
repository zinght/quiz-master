@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Quizes</div>

                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table table-sm ">
                                <thead>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Created By</th>
                                <th></th>
                                </thead>
                                <tbody>
                                @foreach($quizzes as $quiz)
                                    <tr>
                                        <td>{{$quiz->id}}</td>
                                        <td>{{$quiz->name}}</td>
                                        <td>{{$quiz->description}}</td>
                                        <td>{{$quiz->created_by->name}}</td>
                                        <td>
                                            <button type="button" class="btn bt-info">test</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>


                    </div>
                    <div class="card-footer">
                        <a href="{{route('users.create')}}" class="btn btn-primary">Create User</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal_area"></div>

@stop
