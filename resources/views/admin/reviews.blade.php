@extends('admin.master')
@section('content')
    <div class="admin-content-container">
        <h2 class="admin-heading">All Brands</h2>
        <a class="add-new pull-right" href="{{ route('brand.create') }}">Add New</a>
        @if (session('review'))
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <th class="text-center text-success" colspan="3">
                        {{ session('review') }}
                    </th>
                </thead>
            </table>
        @endif
        @if ($reviews->count() > 0)
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <th>User Name</th>
                    <th>Product Name</th>
                    <th>Rating</th>
                    <th>Comment</th>
                    <th>Action</th>
                </thead>
                <tbody>

                    @foreach ($reviews as $review)
                        <tr>
                            <td>{{ $review->user->name }}</td>
                            <td>{{ $review->product->product_name }}</td>
                            <td>{{ $review->rating }}</td>
                            <td>{{ $review->comment }}</td>
                            <td>
                                <form action="{{ route('admindeletereviews', $review->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Delete Review?')"><i
                                            class="fa fa-trash"></i></button>
                                </form>
                                {{-- <a class="delete_brand" href="javascript:void();" data-id=""><i
                                        class="fa fa-trash"></i></a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="col-md-12">
                <div class="pagination-outer">
                    <ul class="pagination">
                        @if (!$reviews->onFirstPage())
                            <li><a href="{{ $reviews->previousPageUrl() }}" class="page-link">Prev</a></li>
                        @endif

                        @foreach ($reviews->links()->elements as $element)
                            @if (is_string($element))
                                <li class="disabled"><span>{{ $element }}</span></li>
                            @endif

                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $reviews->currentPage())
                                        <li class="active"><a class="page-link">{{ $page }}</a></li>
                                    @else
                                        <li><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach


                        @if ($reviews->hasMorePages())
                            <li><a class="page-link" href="{{ $reviews->nextPageUrl() }}">Next</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        @else
            <div class="not-found">!!! No Reviews Found !!!</div>
        @endif

    </div>
@endsection
