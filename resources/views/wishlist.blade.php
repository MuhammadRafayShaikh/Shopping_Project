@extends('master', ['subcategory' => $subcategory, 'cartcount' => $cartcount, 'subcategory2' => $subcategory2, 'wishcount' => $wishcount])

@section('content')
    <div class="product-wishlist-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="section-head">My Wishlist</h2>
                    @if (Auth::check() && $wishcount > 0)
                        <table class="table table-bodered">
                            <thead>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Action</th>
                            </thead>
                            <tbody>

                                @foreach ($wishlist as $wishlists)
                                    <tr>
                                        <td><img src="{{ asset('uploads/' . $wishlists->product->product_image) }}"
                                                alt="" width="100px" /></td>
                                        <td>{{ $wishlists->product->product_name }}</td>
                                        <td>{{ $wishlists->product->product_price }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-primary remove-wishlist-item" href=""
                                                data-id="{{ $wishlists->id }}"><i class="fa fa-remove"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a class="btn btn-sm btn-primary" href="{{ route('cart.index') }}">Proceed to
                            Cart</a>
                    @elseif (Auth::check() && $wishcount === 0)
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="text-center empty-result">
                                        <p>No products were added to the wishlist.</p>
                                        {{-- <h2 class="mb-5">Your Wishlist is currently empty</h2> --}}
                                        <a class="btn btn-sm btn-primary mt-5" href="{{ route('home') }}">Add Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="empty-result">
                            No products were added to the wishlist. <a href="{{ route('login') }}">Click Here to Login</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('.remove-wishlist-item').on('click', function(e) {
            e.preventDefault();
            var wish_id = $(this).data('id');
            var confirmation = confirm('Are you sure to remove this item from wishlist')
            if (confirmation) {

                $.ajax({
                    url: '/wishdelete/' + wish_id,
                    method: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        cart_id: wish_id
                    },
                    success: function(data) {
                        console.log(data);
                        location.reload();
                    }
                })

            } else {
                return false;
            }

        })
    </script>
@endsection
