@extends('master', ['subcategory' => $subcategory, 'cartcount' => $cartcount, 'subcategory2' => $subcategory2])



@section('content')
    @if (session('outofstock'))
        <script>
            alert("{{ session('outofstock') }}");
        </script>
    @endif

    <div id="banner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner-content ">
                        <div class="banner-carousel owl-carousel owl-theme">
                            <div class="item">
                                <img src="images/banner-img-2.jpg" alt="" />
                            </div>
                            <div class="item">
                                <img src="images/banner-img-1.jpg" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-section popular-products">
        <div class="container" id="header">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group search">
                        <input type="text" id="search" class="form-control" name="search"
                            placeholder="Search for...">
                        <span class="input-group-btn">
                            <input class="btn btn-default" type="submit" value="Search" />
                        </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2 class="section-head">Popular Products</h2>
                    <div id="product-results" class="popular-carousel owl-carousel owl-theme">
                        @foreach ($products as $product)
                            <div class="product-grid latest item">
                                <div class="product-image popular">
                                    <a class="image" href="">
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
                                        <a href="">{{ $product->product_name }}</a>
                                    </h3>
                                    <div class="price">{{ $product->product_price }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="section-head">Latest Products</h2>
                    <div class="latest-carousel owl-carousel owl-theme">

                        @foreach ($latestproducts as $latestproduct)
                            <div class="product-grid latest item">
                                <div class="product-image popular">
                                    <a class="image" href="">
                                        <img class="pic-1" src="{{ asset('uploads/' . $latestproduct->product_image) }}">
                                    </a>
                                    <div class="product-button-group">
                                        <a href="{{ route('singleProduct', $latestproduct->id) }}"><i
                                                class="fa fa-eye"></i></a>
                                        <a href="" class="add-to-cart" data-id=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                        <a href="" class="add-to-wishlist" data-id=""><i
                                                class="fa fa-heart"></i></a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3 class="title">
                                        <a href="">{{ $latestproduct->product_name }}</a>
                                    </h3>
                                    <div class="price">{{ $latestproduct->product_price }}</div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                var query = $(this).val(); // Input ki value lena
                $.ajax({
                    url: "{{ route('liveSearch') }}", // Ajax request ko backend me bhejna
                    type: "GET",
                    data: {
                        'search': query
                    }, // Query ko bhejna
                    success: function(data) {
                        $('#product-results').html(
                            data); // Search results ko dynamically render karna
                    }
                });
            });
        });
    </script>
@endsection
