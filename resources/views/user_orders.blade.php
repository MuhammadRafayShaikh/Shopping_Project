@extends('master', ['cartcount' => $cartcount, 'wishcount' => $wishcount, 'subcategory' => $subcategory, 'subcategory2' => $subcategory2])

@section('content')
    <div class="product-cart-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="section-head">My Orders</h2>

                    @if ($orders->count() > 0)
                        <table class="table table-bordered">
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr class="active">
                                        <th colspan="3">
                                            <h4><b>ORDER No : {{ $order->id }}</b></h4>
                                        </th>
                                        <th width="200px"><b>Order Placed : @php
                                            // Database se created_at ko Carbon date me convert karke 4 din add karein
                                            $date = \Carbon\Carbon::parse($order->created_at);
                                        @endphp
                                                {{ $date->format('d-M-Y') }}</b></th>
                                    </tr>

                                    @foreach ($order->orderItems as $orderItem)
                                        <tr>
                                            <td>
                                                <img class="img-thumbnail"
                                                    src="{{ asset('uploads/' . $orderItem->product->product_image) }}"
                                                    alt="" width="100px" />
                                            </td>
                                            <td>
                                                <span><b>Product Name :
                                                        {{ $orderItem->product->product_name }}</b></span><br />
                                                <span><b>Product Price :
                                                        {{ $orderItem->product->product_price }}</b></span><br />
                                                <span><b>Quantity : {{ $orderItem->quantity }}</b> </span><br />
                                            </td>
                                            <td>
                                                <b>Status : {{ $order->order_status }}</b>
                                            </td>
                                            <td>
                                                <span><b>Delivery Expected By :</b>
                                                    @php
                                                        // Database se created_at ko Carbon date me convert karke 4 din add karein
                                                        $expDate = \Carbon\Carbon::parse($order->created_at)->addDays(
                                                            4,
                                                        );
                                                        $expDate2 = \Carbon\Carbon::parse($order->created_at)->addDays(
                                                            7,
                                                        );
                                                    @endphp
                                                    {{ $expDate->format('d-M-Y') }} - {{ $expDate2->format('d-M-Y') }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" align="right"><b>Total Amount</b></td>
                                            <td><b>{{ $order->total_price }}</b></td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="empty-result">
                            No Orders Found.
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
