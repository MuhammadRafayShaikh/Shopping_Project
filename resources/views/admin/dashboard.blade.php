@extends('admin.master')
@section('content')
    <div class="admin-content-container">
        <h2 class="admin-heading">Dashboard</h2>
        <div class="row">
            <div class="col-md-12">

                <table class="table table-bordered">
                    <thead>
                        <tr class="active">
                            <td colspan="2">OUT OF Stock</td>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>Product Code</td>
                            <td></td>
                        </tr>

                    </tbody>
                </table>

            </div>
            <div class="col-md-4">

                <div class="detail-box">
                    <span class="count">{{ $products }}</span>
                    <span class="count-tag">Products</span>
                </div>
            </div>
            <div class="col-md-4">

                <div class="detail-box">
                    <span class="count">{{ $category }}</span>
                    <span class="count-tag">Categories</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="detail-box">

                    <span class="count">{{ $subcategory }}</span>
                    <span class="count-tag">Sub Categories</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="detail-box">

                    <span class="count">{{ $brands }}</span>
                    <span class="count-tag">Brands</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="detail-box">

                    <span class="count">{{ $orders }}</span>
                    <span class="count-tag">Orders</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="detail-box">

                    <span class="count">{{ $users }}</span>
                    <span class="count-tag">Users</span>
                </div>
            </div>
        </div>
    </div>
@endsection
