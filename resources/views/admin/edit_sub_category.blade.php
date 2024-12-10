@extends('admin.master')
@section('content')
<div class="admin-content-container">
    <h3 class="admin-heading">Update Sub Category</h3>

    <div class="row">
        <!-- Form -->
        <form id="updateSubCategory" action="{{ route('subcategory.update',$subcategory->id) }}" class="add-post-form col-md-6" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="sub_cat_id" value="{{ $subcategory->id }}">
            <div class="form-group">
                <label>Sub Category Title</label>
                <input type="text" name="sub_cat_name" class="form-control sub_category" value="{{ $subcategory->sub_cat_name }}" placeholder="" required>
            </div>
            <div class="form-group">
                <label>Category</label>

                <select name="parent_cat" class="form-control parent_cat">
                    <option value="">Select Category</option>
                    @foreach ($category as $categories)

                    <option @if ($categories->id == $subcategory->cat_name)
                        {{ 'selected' }}
                        @else
                        {{ '' }}
                        @endif value="{{ $categories->id }}">{{ $categories->category_name }}
                    </option>
                    @endforeach

                </select>
            </div>
            <input type="submit" name="sumbit" class="btn add-new" value="Update" />
        </form>
        <!-- /Form -->
    </div>

    <!-- <div class="empty-result">!!! Result Not Found !!!</div> -->
</div>


@endsection