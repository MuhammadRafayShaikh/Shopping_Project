@extends('admin.master')
@section('content')
    <div class="admin-content-container">
        <h2 class="admin-heading">All Categories</h2>
        <a class="add-new pull-right" href="{{ route('category.create') }}">Add New</a>

        @if (session('category'))
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <th class="text-center text-success" colspan="3">
                        {{ session('category') }}
                    </th>
                </thead>
            </table>
        @endif
        @if ($category)
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($category as $categories)
                        <tr>
                            <td>{{ $categories->id }}</td>
                            <td>{{ $categories->category_name }}</td>
                            <td>
                                <a href="{{ route('category.edit', $categories->id) }}"><i class="fa fa-edit"></i></a>
                                <!-- <a class="delete_category" href="javascript:void()" data-id=""><i class="fa fa-trash"></i></a> -->
                                <a class="delete_category">
                                    <form action="{{ route('category.destroy', $categories->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"><i class="fa fa-trash"></i></button>
                                    </form>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        @else
            <div class="not-found">!!! No Category Available !!!</div>
        @endif
        <div class="col-md-12">
            <div class="pagination-outer">
                <ul class="pagination">
                    @if (!$category->onFirstPage())
                        <li><a href="{{ $category->previousPageUrl() }}" class="page-link">Prev</a></li>
                    @endif

                    @foreach ($category->links()->elements as $element)
                        @if (is_string($element))
                            <li class="disabled"><span>{{ $element }}</span></li>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $category->currentPage())
                                    <li class="active"><a class="page-link">{{ $page }}</a></li>
                                @else
                                    <li><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach


                    @if ($category->hasMorePages())
                        <li><a class="page-link" href="{{ $category->nextPageUrl() }}">Next</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endsection
