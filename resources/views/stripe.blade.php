<!DOCTYPE html>
<html>

<head>
    <title>Stripe Payment</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Stripe Payment</h1>
        <h2 class="text-center text-danger">Please Complete Your Payment</h2>
        <form id="payment-form" class="mt-4">
            <div class="form-group">
                <label for="card-number">Card Number</label>
                <div id="card-number" class="form-control" style="padding: 10px;"></div>
                <div id="card-errors" role="alert" class="text-danger"></div>
            </div>
            <input type="hidden" id="total_amount" name="total_amount" value="{{ $amount }}">

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="expiry">Expiry Date (MM/YY)</label>
                    <div id="expiry" class="form-control" style="padding: 10px;"></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="cvv">CVV</label>
                    <div id="cvv" class="form-control" style="padding: 10px;"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="zip">ZIP Code</label>
                <input type="text" id="zip" class="form-control" placeholder="ZIP Code" required>
            </div>
            <button id="submit" class="btn btn-primary btn-block">Pay</button>
            <div id="payment-response" class="mt-3"></div>
        </form>
    </div>


</body>

</html>
