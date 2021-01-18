@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Users</div>

                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table table-sm ">
                                <thead>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group" >
                                                <a type="button" href="{{route('users.edit', [$user])}}" class="btn btn-warning btn-sm edit_user"  >Edit</a>
                                                <button type="button" class="btn btn-danger btn-sm delete_user" data-url="{{route('users.delete', [$user])}}">Delete</button>
                                            </div>
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
@endsection
@section('javascript')
    <script>
        $( document ).ready(function() {
            $(".edit_user").click(function(){
                let url = $(this).data('url');
                console.log(url);
                $.ajax({
                    /* the route pointing to the post function */
                    url: url,
                    type: 'get',
                    success: function (data) {
                        $("#delete_modal").html(resp);
                        $("#delete_modal").modal('show');
                    }
                });
            });
            $(".delete_user").click(function(){
                let url = $(this).data('url');
                console.log(url);
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
