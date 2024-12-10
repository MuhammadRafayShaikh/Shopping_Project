@extends('master')

@section('content')
    <div class="product-section content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="section-head">All Products</h2>

                    @foreach ($products as $product)
                        <div class="col-md-3 col-sm-6">
                            <div class="product-grid">
                                <div class="product-image latest">
                                    <a class="image" href="single_product.php?pid=">
                                        <img class="pic-1" src="{{ asset('uploads/' . $product->product_image) }}">
                                    </a>
                                    <div class="product-button-group">
                                        <a href="{{ route('singleProduct', $product->id) }}"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('cart.index') }}" class="add-to-cart" data-id=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                        <a href="{{ route('wishlist.index') }}" class="add-to-wishlist" data-id=""><i
                                                class="fa fa-heart"></i></a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3 class="title">
                                        <a href="single_product.php?pid=">{{ $product->product_name }}</a>
                                    </h3>
                                    <div class="price">{{ $product->product_price }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
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



            </div>
        </div>
    </div>
@endsection
