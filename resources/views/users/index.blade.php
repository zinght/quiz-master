@extends('layouts.app')
@section('content')
    <div class="container h-100">
        <div class="row justify-content-center h-100 ">
            <div class="col-md-10 h-100">
                <div class="card mh-50">
                    <div class="card-header">Users</div>

                    <div class="card-body h-100">

                        <div class="table-responsive h-100">
                            <table class="table table table-sm h-100">
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

                                           @include('users.includes.index_table_buttons')
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
            $('.table-responsive').on('show.bs.dropdown', function () {
                $('.table-responsive').css( "overflow", "inherit" );
            });
            $(".edit_user").click(function(){
                let url = $(this).data('url');
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
