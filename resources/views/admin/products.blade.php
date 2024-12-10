@extends('admin.master')
@section('content')

    <div class="admin-content-container">
        <h2 class="admin-heading">All Products</h2>
        <a class="add-new pull-right" href="{{ route('product.create') }}">Add New</a>
        @if (session('product'))
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <th class="text-center text-success" colspan="3">
                        {{ session('product') }}
                    </th>
                </thead>
            </table>
        @endif
        @if ($products->count() > 0)
            <table id="productsTable" class="table table-striped table-hover table-bordered">
                <thead>
                    <th>#</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th width="100px">Action</th>
                </thead>
                <tbody>

                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td><b>{{ $product->product_name }}</b></td>
                            <td>{{ $product->subcategory->sub_cat_name }}</td>
                            <td>{{ $product->brand->brand }}</td>
                            <td>{{ $product->product_price }}</td>
                            <td>{{ $product->product_qty }}</td>
                            <td>
                                <img src="{{ asset('uploads/' . $product->product_image) }}" alt=""
                                    width="50px" />
                            </td>

                            <td>
                                <a href="{{ route('product.edit', $product->id) }}"><i class="fa fa-edit"></i></a>
                                <!-- <a class="delete_product" href="javascript:void()" data-id="" data-subcat=""><i class="fa fa-trash"></i></a> -->
                                <form action="{{ route('product.destroy', [$product->id, $product->product_sub_cat]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="col-md-12">
                <div class="pagination-outer">
                    <ul class="pagination">
                        @if (!$products->onFirstPage())
                            <li><a href="{{ $products->previousPageUrl() }}" class="page-link">Prev</a></li>
                        @endif

                        @foreach ($products->links()->elements as $element)
                            @if (is_string($element))
                                <li class="disabled"><span>{{ $element }}</span></li>
                            @endif

                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $products->currentPage())
                                        <li class="active"><a class="page-link">{{ $page }}</a></li>
                                    @else
                                        <li><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach


                        @if ($products->hasMorePages())
                            <li><a class="page-link" href="{{ $products->nextPageUrl() }}">Next</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        @else
            <div class="not-found clearfix">!!! No Products Found !!!</div>
        @endif
    </div>


@endsection
