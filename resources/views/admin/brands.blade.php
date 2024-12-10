@extends('admin.master')
@section('content')
    <div class="admin-content-container">
        <h2 class="admin-heading">All Brands</h2>
        <a class="add-new pull-right" href="{{ route('brand.create') }}">Add New</a>
        @if (session('brand'))
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <th class="text-center text-success" colspan="3">
                        {{ session('brand') }}
                    </th>
                </thead>
            </table>
        @endif
        @if ($brands->count() > 0)
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Action</th>
                </thead>
                <tbody>

                    @foreach ($brands as $brand)
                        <tr>
                            <td>{{ $brand->brand }}</td>
                            <td>{{ $brand->category->sub_cat_name }}</td>
                            <td>
                                <a href="{{ route('brand.edit', $brand->id) }}"><i class="fa fa-edit"></i></a>
                                <a class="delete_brand" href="javascript:void();" data-id=""><i
                                        class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="not-found">!!! No Barnds Found !!!</div>
        @endif
        <div class="col-md-12">
            <div class="pagination-outer">
                <ul class="pagination">
                    @if (!$brands->onFirstPage())
                        <li><a href="{{ $brands->previousPageUrl() }}" class="page-link">Prev</a></li>
                    @endif

                    @foreach ($brands->links()->elements as $element)
                        @if (is_string($element))
                            <li class="disabled"><span>{{ $element }}</span></li>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $brands->currentPage())
                                    <li class="active"><a class="page-link">{{ $page }}</a></li>
                                @else
                                    <li><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach


                    @if ($brands->hasMorePages())
                        <li><a class="page-link" href="{{ $brands->nextPageUrl() }}">Next</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endsection
