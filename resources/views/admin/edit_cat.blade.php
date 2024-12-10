@extends('admin.master')

@section('content')


<div class="admin-content-container">
    <h3 class="admin-heading">update category</h3>

    <div class="row">
        <!-- Form -->
        <form id="updateCategory" class="add-post-form col-md-6" method="POST" action="{{ route('category.update',$category->id) }}">
            @csrf
            @method('PUT')
            <input type="hidden" name="cat_id" value="{{ $category->id }}">
            <div class="form-group">
                <label>Category Name</label>
                <input type="text" name="c_name" class="form-control" value="{{ $category->category_name }}" placeholder="Category Name" required />
            </div>
            <input type="submit" class="btn add-new" value="Update" />
        </form>
        <!-- /Form -->
    </div>

    <div class="not-found">!!! Result Not Found !!!</div>

</div>


@endsection