@extends('admin.master')
@section('content')
    <div class="admin-content-container">
        <h2 class="admin-heading">Edit Product</h2>

        <form id="updateProduct" action="{{ route('product.update', $product->id) }}" class="add-post-form row" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-md-9">
                <div class="form-group">
                    <label for="">Product Title</label>
                    <input type="hidden" name="product_id" value="{{ $product->id }}" />
                    <input type="text" class="form-control product_title" name="product_title"
                        value="{{ $product->product_name }}" placeholder="Product Title" />
                </div>
                <div class="form-group category">
                    <label for="">Product Category</label>

                    <select class="form-control product_category" name="product_cat">
                        <option value="" disabled>Select Category</option>
                        @foreach ($category as $category)
                            <option value="{{ $category->id }}" @if ($category->id == $product->product_cat) selected @endif>
                                {{ $category->category_name }}</option>
                        @endforeach
                    </select>


                </div>
                <div class="form-group sub_category">
                    <label for="">Product Sub-Category</label>

                    <select class="form-control product_sub_category" name="product_sub_cat">
                        <option value="" disabled>Select Subcategory</option>
                        @foreach ($subcategory as $subcategory)
                            <option value="{{ $subcategory->id }}" @if ($subcategory->id == $product->product_sub_cat) selected @endif>
                                {{ $subcategory->sub_cat_name }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="product_old_sub_cat" value="{{ $product->product_sub_cat }}">


                </div>
                <div class="form-group brand">
                    <label for="">Product Brand</label>

                    <select class="form-control product_brands" name="product_brand">
                        <option value="" disabled>Select Brand</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" @if ($brand->id == $product->product_brand) selected @endif>
                                {{ $brand->brand }}</option>
                        @endforeach
                    </select>


                </div>
                <div class="form-group">
                    <label for="">Product Description</label>
                    <textarea class="form-control product_description" name="product_desc" rows="8" cols="80">{{ $product->product_desc }}</textarea>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Featured Image</label>
                    <input type="file"
                        onchange="document.querySelector('#image').src=window.URL.createObjectURL(this.files[0])"
                        class="product_image" name="image">
                    <!-- <input type="hidden" class="old_image" name="old_image" value=""> -->
                    <img id="image" src="{{ asset('uploads/' . $product->product_image) }}" alt=""
                        width="100px" />
                </div>
                <div class="form-group">
                    <label for="">Product Price</label>
                    <input type="text" class="form-control product_price" name="product_price"
                        value="{{ $product->product_price }}">
                </div>
                <div class="form-group">
                    <label for="">Available Quantity</label>
                    <input type="number" class="form-control product_qty" name="product_qty"
                        value="{{ $product->product_qty }}">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn add-new" value="Update">
                </div>
            </div>
        </form>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var selectedCategory = $('.product_category').val();
            var selectedSubcategory = "{{ $product->product_sub_cat }}";
            var selectedBrand = "{{ $product->product_brand }}";

            if (selectedCategory) {
                $.ajax({
                    url: '/get-subcategories/' + selectedCategory,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('.product_sub_category').empty();

                        $.each(data, function(key, value) {
                            $('.product_sub_category').append('<option value="' + value.id +
                                '"' + (value.id == selectedSubcategory ? ' selected' : '') +
                                '>' + value.sub_cat_name + '</option>');
                        });
                    }
                });
            }

            if (selectedSubcategory) {
                $.ajax({
                    url: '/get-brands/' + selectedSubcategory,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('.product_brands').empty();

                        $.each(data, function(key, value) {
                            $('.product_brands').append('<option value="' + value.id + '"' + (
                                    value.id == selectedBrand ? ' selected' : '') + '>' +
                                value.brand + '</option>');
                        });
                    }
                });
            }

            $('.product_category').on('change', function() {
                var product_category = $(this).val();
                $.ajax({
                    url: '/get-subcategories/' + product_category,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('.product_sub_category').empty();
                        $('.product_sub_category').append(
                            '<option value="" disabled selected>Select Subcategory</option>'
                        );

                        $.each(data, function(key, value) {
                            $('.product_sub_category').append('<option value="' + value
                                .id + '">' + value.sub_cat_name + '</option>');
                        });
                    }
                });
            });

            $('.product_sub_category').on('change', function() {
                var product_subcategory = $(this).val();
                $.ajax({
                    url: '/get-brands/' + product_subcategory,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('.product_brands').empty();
                        $('.product_brands').append(
                            '<option value="" disabled selected>Select Brand</option>');

                        $.each(data, function(key, value) {
                            $('.product_brands').append('<option value="' + value.id +
                                '">' + value.brand + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@endsection
