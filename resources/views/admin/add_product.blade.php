@extends('admin.master')
@section('content')

<div class="admin-content-container">
    <h2 class="admin-heading">Add New Product</h2>
    <form id="createProduct" action="{{ route('product.store') }}" class="add-post-form row" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-md-9">
            <div class="form-group">
                <label for="">Product Title</label>
                <input type="text" class="form-control product_title" name="product_title" placeholder="Product Title" requried />
            </div>
            <div class="form-group category">
                <label for="">Product Category</label>

                <select class="form-control product_category" name="product_cat">
                    <option value="" selected disabled>Select Category</option>
                    @foreach ($category as $categories)

                    <option value="{{ $categories->id }}">{{ $categories->category_name }}</option>
                    @endforeach

                </select>
            </div>
            <div class="form-group sub_category">
                <label for="">Product Sub-Category</label>
                <select class="form-control product_sub_category" name="product_sub_cat">

                    <option value="" selected disabled>First Select Category</option>

                </select>
            </div>
            <div class="form-group brand">
                <label for="">Product Brand</label>
                <select class="form-control product_brands" name="product_brand">
                    <option value="" selected disabled>First Select Sub Category</option>

                </select>
            </div>
            <div class="form-group">
                <label for="">Product Description</label>
                <textarea class="form-control product_description" name="product_desc" rows="8" cols="80" requried></textarea>
            </div>
            <div class="show-error"></div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">Featured Image</label>
                <input type="file" class="product_image" requried name="image">
                <img id="image" src="" width="150px" />
            </div>
            <div class="form-group">
                <label for="">Product Price</label>
                <input type="text" class="form-control product_price" name="product_price" requried value="">
            </div>
            <div class="form-group">
                <label for="">Available Quantity</label>
                <input type="number" class="form-control product_qty" name="product_qty" requried value="">
            </div>

            <div class="form-group">
                <input type="submit" class="btn add-new" value="Submit">
            </div>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // category 
        $('.product_category').on('change', function() {
            var category_id = $(this).val();
            if (category_id) {
                console.log(category_id);
                $.ajax({
                    url: '/get-subcategories/' + category_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // console.log(data);
                        $('.product_sub_category').empty(); // Clear previous subcategories
                        $('.product_sub_category').append('<option value="" disabled selected>Select Subcategory</option>');
                        $.each(data, function(key, value) {
                            $('.product_sub_category').append('<option value="' + value.id + '">' + value.sub_cat_name + '</option>');
                        });
                    }
                });
            }
        });

        //sub_category

        $('.product_sub_category').on('change', function() {
            var sub_category_id = $(this).val();
            // console.log(category_id);
            $.ajax({
                url: "/get-brands/" + sub_category_id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    $('.product_brands').empty();
                    $('.product_brands').append('<option value="" selected disabled>Select Brand</option>')
                    $.each(data, function(key, value) {
                        $('.product_brands').append(`<option value="${value.id}">${value.brand}</option>`)
                    })
                }
            })

        })

    });
</script>
@endsection