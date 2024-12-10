@extends('admin.master')
@section('content')
    <div class="admin-content-container">
        <h2 class="admin-heading">All Users</h2>

        @if ($users->count() > 0)
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <th>Full Name</th>
                    <th>Email</th>
                    {{-- <th>Mobile</th>
                <th>City</th> --}}
                    <th>Action</th>
                </thead>
                <tbody>

                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            {{-- <td></td>
                        <td></td> --}}
                            <td>
                                <a href="" class="btn btn-xs btn-primary user-view" data-id="{{ $user->id }}"
                                    data-toggle="modal" data-target="#user-detail"><i class="fa fa-eye"></i></a>
                                @if ($user->role == 1)
                                    {{-- <a href="">
                                    <form action="">
                                        <button type="submit" class="btn btn-xs btn-primary user-status">Block</button>
                                    </form>
                                </a> --}}
                                    <a href="" class="btn btn-xs btn-primary user-status"
                                        data-id="{{ $user->id }}" data-status="">Block</a>
                                @else
                                    <a href="" class="btn btn-xs btn-primary user-status2"
                                        data-id="{{ $user->id }}" data-status="">Unblock</a>
                                @endif

                                <a class="btn btn-xs btn-danger delete_user" href="" data-id="{{ $user->id }}"><i
                                        class="fa fa-trash"></i></a>

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        
        <div class="col-md-12">
            <div class="pagination-outer">
                <ul class="pagination">
                    @if (!$users->onFirstPage())
                        <li><a href="{{ $users->previousPageUrl() }}" class="page-link">Prev</a></li>
                    @endif

                    @foreach ($users->links()->elements as $element)
                        @if (is_string($element))
                            <li class="disabled"><span>{{ $element }}</span></li>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $users->currentPage())
                                    <li class="active"><a class="page-link">{{ $page }}</a></li>
                                @else
                                    <li><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach


                    @if ($users->hasMorePages())
                        <li><a class="page-link" href="{{ $users->nextPageUrl() }}">Next</a></li>
                    @endif
                </ul>
            </div>
        </div>
        @else
            <div class="not-found clearfix">!!! No Users Found !!!</div>
        @endif

    </div>
    <!-- Modal -->
    <div class="modal fade" id="user-detail" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <!-- /Modal -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.user-view').on('click', function() {
                var user_id = $(this).data('id');

                $.ajax({
                    url: 'singleuser/' + user_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);

                        var output = `
                         <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <th>Full Name</th>
                                <th>Email</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>${data.name}</td>
                                    <td>${data.email}</td>
                                </tr>
                            </tbody>
                        </table>
                        `
                        $('.modal-body').empty();
                        $('.modal-body').append(output)
                    }
                })
            })


            $('.user-status').on('click', function(e) {
                e.preventDefault();
                var user_status = $(this).data('id');
                // alert(user_status)
                var confirmation = confirm("Are you sure you want to block this user?");

                if (confirmation) {

                    $.ajax({
                        url: '/blockuser',
                        method: "POST",
                        data: {
                            user_status: user_status,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            // console.log(data);

                            alert(data.status)
                            window.location.href = '/user'
                        }

                    })

                } else {
                    return false;
                }
            })



            $('.user-status2').on('click', function(e) {
                e.preventDefault();
                var user_status = $(this).data('id');
                // alert(user_status)
                var confirmation = confirm('Are you sure you want to unblock this user?');
                if (confirmation) {

                    $.ajax({
                        url: '/blockuser2',
                        method: "POST",
                        data: {
                            user_status: user_status,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            console.log(data);
                            alert(data.status)
                            window.location.href = '/user'

                        }
                    })


                } else {
                    return false;
                }
            })

            $('.delete_user').on('click', function(e) {
                e.preventDefault()

                var user_id = $(this).data('id');

                var confirmation = confirm('Are you sure to want to delete this user');

                if (confirmation) {
                    $.ajax({
                        url: '/user/' + user_id,
                        method: "DELETE",
                        data: {
                            user_id: user_id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            console.log(data);
                            alert(data.msg)
                            location.reload();
                        }
                    })
                } else {
                    return false;
                }
            })
        })
    </script>
@endsection
