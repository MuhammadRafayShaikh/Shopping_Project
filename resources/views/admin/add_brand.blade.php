@extends('admin.master')

@section('content')
    <div class="admin-content-container">
        <h2 class="admin-heading">Add New Brand</h2>
        <div class="row">

            <!-- Form -->
            <form id="createBrand" action="{{ route('brand.store') }}" class="add-post-form col-md-6" method="POST"
                autocomplete="off">
                @csrf
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="brand_name" class="form-control brand_name" placeholder="Brand Name" />
                </div>
                <div class="form-group">
                    <label for="">Brand Category</label>

                    <select class="form-control brand_category" name="brand_cat">
                        <option value="" selected disabled>Select Category</option>
                        @foreach ($subcategory as $categories)
                            <option value="{{ $categories->id }}">{{ $categories->sub_cat_name }}</option>
                        @endforeach

                    </select>
                </div>
                <input type="submit" class="btn add-new" value="Submit" /></button>
            </form>
            <!-- /Form -->
        </div>
    </div>
@endsection
