@extends('layouts.app')
@section('content')
    <div class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="col-md-10 h-100" >
                <div class="card mh-50">
                    <div class="card-header">Quizzes</div>

                    <div class="card-body h-100">

                        <div class="table-responsive h-100">
                            <table class="table table table-sm h-100 ">
                                <thead>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Created By</th>
                                <th></th>
                                </thead>
                                <tbody>
                                @if(isset($quizzes))
                                    @foreach($quizzes as $quiz)

                                        <tr>
                                            <td>
                                                {{$quiz->id}}
                                            </td>
                                            <td>{{$quiz->name}}</td>
                                            <td>{{$quiz->description}}</td>
                                            <td>
                                                @if(auth()->user()->can('manage users'))
                                                    <a class="btn btn-primary btn-sm text-white" href="{{route('users.edit', [$quiz->created_by])}}">{{$quiz->createdby->name}}</a>
                                                @else
                                                    {{$quiz->createdby->name}}
                                                @endif

                                            </td>
                                            <td>
                                                @include('quizzes.includes.index_table_buttons')
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>


                    </div>
                    <div class="card-footer">
                        <a href="{{route('quizzes.create')}}" class="btn btn-primary">Create Quiz</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal_area"></div>

@stop
@section('javascript')
    <script>
        $( document ).ready(function() {
            $('.table-responsive').on('show.bs.dropdown', function () {
                $('.table-responsive').css( "overflow", "inherit" );
            });

            $(".delete_quiz").click(function(){
                let url = $(this).data('url');
                $.ajax({
                    /* the route pointing to the post function */
                    url: url,
                    type: 'get',
                    success: function (data) {
                        if(data.type == "redirect")
                        {
                            window.location.href = data.data;
                        }
                        $(".modal_area").html(data);
                        var modal = document.getElementById('delete_modal');
                        $('#delete_modal').modal('show');
                    }
                });
            });
        });

    </script>
@endsection
