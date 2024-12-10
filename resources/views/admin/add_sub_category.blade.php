@extends('admin.master')
@section('content')
<div class="admin-content-container">
    <h2 class="admin-heading">Add New Sub Category</h2>
    <div class="row">
        <!-- Form -->
        <form id="createSubCategory" action="{{ route('subcategory.store') }}" class="add-post-form col-md-6" method="POST">
            @csrf
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="c_name" class="form-control sub_category" placeholder="Sub Category Name" />
            </div>
            <div class="form-group">
                <label for="">Parent Category</label>

                <select class="form-control parent_cat" name="c_id">
                    <option value="" selected disabled>Select Category</option>

                    @foreach ($category as $categories)

                    <option value="{{ $categories->id }}">{{ $categories->category_name }}</option>

                    @endforeach


                </select>
            </div>
            <input type="submit" class="btn add-new" value="Submit" />
        </form>
        <!-- /Form -->
    </div>
</div>
@endsection