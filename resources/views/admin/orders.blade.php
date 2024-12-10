@extends('admin.master')

@section('content')
    <div class="admin-content-container">
        <h2 class="admin-heading">All Orders</h2>

        <table class="table table-striped table-hover table-bordered">
            <thead>
                <th>ORDER No.</th>
                <th width="300px">Product Details</th>
                <th>QTY.</th>
                <th>Total Amount</th>
                <th>Customer Details</th>
                <th>Order Date</th>
                <th>Payment Status</th>
                <th>Delivery Status</th>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>
                            @php
                                $productDetails = $order->orderItems
                                    ->map(function ($item) {
                                        return $item->product->product_name . ' (Qty: ' . $item->quantity . ')';
                                    })
                                    ->join(', ');
                            @endphp
                            {{ $productDetails }}
                        </td>
                        <td>{{ $order->orderItems->sum('quantity') }}</td>
                        <td>{{ $order->total_price }}</td>
                        <td>
                            <b>Name : </b>{{ $order->user->name }}<br>
                            <b>Email : </b>{{ $order->user->email }}<br>
                            <b>Address : </b>{{ $order->address }}<br>
                        </td>
                        <td>{{ $order->created_at->format('d-m-Y') }}</td>
                        <td>
                            @if ($order->payment_status === 'paid')
                                <span class="label label-success">Paid</span>
                            @else
                                {{-- <button class="label label-warning payment-status"
                                    data-order-id="{{ $order->id }}">Pending</button> --}}
                                <form action="{{ route('backorder.update', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button class="label label-success" style="border: none" type="submit">Pending</button>
                                </form>
                            @endif
                        </td>
                        <td>
                            @if ($order->order_status === 'delivered')
                                <span class="label label-primary">Delivered</span>
                            @else
                                {{-- <span>{{ ucfirst($order->order_status) }}</span>
                                <a class="btn btn-sm btn-primary order_complete" href=""
                                    data-id="{{ $order->id }}">Complete</a> --}}
                                <form action="{{ route('backorder.update2', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button class="label label-primary" style="border: none"
                                        type="submit">Processing</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">!!! No Orders Found !!!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="col-md-12">
            <div class="pagination-outer">
                <ul class="pagination">
                    @if (!$orders->onFirstPage())
                        <li><a href="{{ $orders->previousPageUrl() }}" class="page-link">Prev</a></li>
                    @endif

                    @foreach ($orders->links()->elements as $element)
                        @if (is_string($element))
                            <li class="disabled"><span>{{ $element }}</span></li>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $orders->currentPage())
                                    <li class="active"><a class="page-link">{{ $page }}</a></li>
                                @else
                                    <li><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach


                    @if ($orders->hasMorePages())
                        <li><a class="page-link" href="{{ $orders->nextPageUrl() }}">Next</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.payment-status').on('click', function() {
                var orderId = $(this).data('order-id');
                var statusLabel = $(this);

                $.ajax({
                    url: '/backorders/' + orderId + '/update-payment-status',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);

                        if (response.success) {
                            // Change the text to 'Paid'
                            statusLabel.removeClass('label-warning').addClass('label-success')
                                .text('Paid');
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Check for error response
                        alert('Something went wrong. Please try again.');
                    }
                });
            });
        });
    </script>
@endsection
