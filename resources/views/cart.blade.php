@extends('master', ['subcategory' => $subcategory, 'cartcount' => $cartcount])
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <div class="product-cart-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12 clearfix">
                    <h2 class="section-head">My Cart</h2>
                    <!-- Static Cart Table -->
                    @if (Auth::check() && $cartcount > 0)
                        <table class="table table-bordered">
                            <thead>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th width="120px">Product Price</th>
                                <th width="100px">Qty.</th>
                                <th width="100px">Sub Total</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($carts as $cart)
                                    <tr class="item-row">
                                        <td><img src="{{ asset('uploads/' . $cart->product->product_image) }}"
                                                alt="" width="70px" /></td>
                                        <td>{{ $cart->product->product_name }}</td>
                                        <td><span class="product-price">{{ $cart->product->product_price }}</span></td>
                                        <td>
                                            <input class="form-control item-qty" type="number" min="1"
                                                max="{{ $cart->product->product_qty }}" value="{{ $cart->quantity }}"
                                                data-cart-id="{{ $cart->id }}"
                                                data-product-price="{{ $cart->product->product_price }}" />
                                        </td>
                                        <td><span
                                                class="sub-total">{{ $cart->product->product_price * $cart->quantity }}</span>
                                            <input type="hidden" id="total_amount"
                                                value="{{ $cart->product->product_price * $cart->quantity }}">
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-primary remove-cart-item" href=""
                                                data-id="{{ $cart->id }}"><i class="fa fa-remove"></i></a>
                                        </td>
                                    </tr>
                                @endforeach


                                <tr>
                                    <td colspan="5" align="right"><b>TOTAL AMOUNT ($)</b></td>
                                    <td class="total-amount">$220.00</td>
                                </tr>
                            </tbody>
                        </table>

                        <a class="btn btn-sm btn-primary" href="{{ route('home') }}">Continue Shopping</a>
                        {{-- <a href="" id="userLogin_form">Proceed to Checkout</a> --}}
                        <button data-toggle="modal" class="checkout-form pull-right btn btn-md btn-success"
                            data-target="#userLogin_form" href="#">Proceed to Checkout</button>
                        <div class="modal fade" id="userLogin_form" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <div class="modal-body">
                                        <form action="{{ route('order') }}" method="POST" id="">
                                            @csrf
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ Auth::user()->name }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ Auth::user()->email }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control" name="address"
                                                    placeholder="Complete Address" required>
                                            </div>
                                            {{-- <div class="form-group">
                                                <label>Account Setting</label>
                                                <div class="form-control" id="card-element"></div>
                                                <div id="payment-response"></div>
                                            </div> --}}
                                            {{-- <div id="card-element"></div> <!-- Stripe Element -->
                                            <div id="card-errors" role="alert"></div> --}}
                                            <button type="submit" class="btn btn-success">Checkout</button>
                                        </form>

                                        {{-- <script src="https://js.stripe.com/v3/"></script> --}}
                                        {{-- <script>
                                            // Add your Stripe JavaScript code here
                                        </script> --}}

                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <form action="instamojo.php" class="checkout-form pull-right" method="POST">
                            <input type="hidden" name="product_id" value="1,2">
                            <input type="hidden" name="product_total" class="total-price" value="220.00">
                            <input type="hidden" name="product_qty" class="total-qty" value="2">
                            <input type="submit" class="btn btn-md btn-success" value="Proceed to Checkout">
                        </form> --}}
                    @elseif (Auth::check() && $cartcount === 0)
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="text-center empty-result">
                                        <p>No products were added to the cart.</p>
                                        <a class="btn btn-sm btn-primary mt-5" href="{{ route('home') }}">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="empty-result">
                            No products were added to the cart. <a href="{{ route('login') }}">Click Here to Login</a>
                        </div>
                    @endif

                    <!-- Checkout Button -->
                    <?php
                    //  if (isset($_SESSION['user_role'])) {
                    ?>
                    {{-- <form action="instamojo.php" class="checkout-form pull-right" method="POST">
                        <input type="hidden" name="product_id" value="1,2">
                        <input type="hidden" name="product_total" class="total-price" value="220.00">
                        <input type="hidden" name="product_qty" class="total-qty" value="2">
                        <input type="submit" class="btn btn-md btn-success" value="Proceed to Checkout">
                    </form> --}}
                    <?php
                    //  } else {
                    ?>
                    {{-- <a class="btn btn-sm btn-success pull-right" href="#" data-toggle="modal"
                        data-target="#userLogin_form">Proceed to Checkout</a> --}}
                    <?php
                    //  }
                    ?>

                </div>
            </div>
        </div>
    </div>
    {{-- <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('{{ env('STRIPE_KEY') }}'); // Your publishable key
        var elements = stripe.elements();

        var cardElement = elements.create('card');
        cardElement.mount('#card-element');

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(cardElement).then(function(result) {
                if (result.error) {
                    // Show error in #card-errors
                    document.getElementById('card-errors').textContent = result.error.message;
                } else {
                    // Otherwise send the token to your server
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', result.token.id);
                    form.appendChild(hiddenInput);

                    // Submit the form
                    form.submit();
                }
            });
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            $('.item-qty').on('change', function() {
                var cart_id = $(this).data('cart-id');
                var quantity = $(this).val();
                var product_price = $(this).data('product-price');
                var row = $(this).closest('tr'); // Getting the table row to update subtotal

                $.ajax({
                    url: '/cartupdate/' + cart_id,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        quantity: quantity,
                        product_price: product_price // Send product price to the server
                    },
                    success: function(response) {
                        if (response.success) {
                            var newSubtotal = product_price * quantity;
                            row.find('.sub-total').text(newSubtotal.toFixed(
                                2)); // Update subtotal in table row

                            // Optionally, update the total amount for all products
                            updateTotalAmount();
                        } else {
                            alert(response.message);
                        }
                    }
                });
            });


            $('.remove-cart-item').on('click', function(e) {
                e.preventDefault();
                var cart_id = $(this).data('id');
                var confirmation = confirm('Are you sure to remove this item from cart')
                if (confirmation) {

                    $.ajax({
                        url: '/cartdelete/' + cart_id,
                        method: "POST",
                        data: {
                            _token: '{{ csrf_token() }}',
                            cart_id: cart_id
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

            function updateTotalAmount() {
                var totalAmount = 0;
                $('.sub-total').each(function() {
                    totalAmount += parseFloat($(this).text());
                });
                $('.total-amount').text(totalAmount.toFixed(2)); // Update total amount
            }
        });
    </script>

    {{-- <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ env('STRIPE_KEY') }}'); // Use your own publishable key
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');
    </script> --}}

    {{-- <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Create a Stripe client.
        var stripe = Stripe('YOUR_PUBLIC_KEY'); // Replace with your own public key

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Create an instance of the card Element.
        var card = elements.create('card');

        // Add an instance of the card Element into the `card-element` div.
        card.mount('#card-element');

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Show error in #card-errors
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', result.token.id);
                    form.appendChild(hiddenInput);

                    // Submit the form
                    form.submit();
                }
            });
        });
    </script> --}}

    {{-- <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        var elements = stripe.elements();
        var cardElement = elements.create('card');
        cardElement.mount('#card-element');

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(cardElement).then(function(result) {
                if (result.error) {
                    // Display error in #card-errors
                    document.getElementById('card-errors').textContent = result.error.message;
                } else {
                    // Send the token to your server
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', result.token.id);
                    form.appendChild(hiddenInput);

                    // Submit the form
                    form.submit();
                }
            });
        });
    </script> --}}

    {{-- <script>
        const stripe = Stripe('pk_test_51QC2ODIe4idSW70t3KGivHvvWGDachFhshcM3FC3kUOGiog9iupBTWRzeSR622duJ94Vzpuk034kvUAHK9OdviY100JX1FOvsF');
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        $('#payment-form').on('submit', async function(event) {
            event.preventDefault();

            try {
                const {
                    paymentMethod,
                    error
                } = await stripe.createPaymentMethod({
                    type: 'card',
                    card: cardElement,
                });

                if (error) {
                    throw new Error(error.message);
                }

                const csrfToken = $('meta[name="csrf-token"]').attr('content');

                var total_amount = $("#total_amount").val();

                $.ajax({
                    url: '/payment',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    contentType: 'application/json',
                    data: JSON.stringify({
                        stripeToken: paymentMethod.id,
                        amount: total_amount
                    }),
                    success: function(result) {
                        const response = result.success ?
                            'Payment Successful!' :
                            'Payment Failed: ' + result.error;
                        $('#payment-response').text(response);
                    },
                    error: function(xhr) {
                        $('#payment-response').text('Error: ' + xhr.responseJSON.error);
                    }
                });
            } catch (err) {
                $('#payment-response').text('Error: ' + err.message);
            }
        });
    </script> --}}


@endsection
