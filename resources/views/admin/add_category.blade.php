@extends('admin.master')
@section('content')
<div class="admin-content-container">
    <h2 class="admin-heading">Add New Category</h2>

    <!-- Form -->
    <div class="row">
        <form id="createCategory" action="{{ route('category.store') }}" class="add-post-form col-md-6" method="POST">
            @csrf
            <div class="form-group">
                <label>Category Name</label>
                <input type="text" name="c_name" class="form-control category" placeholder="Category Name" required />
            </div>
            <input type="submit" class="btn add-new" value="Submit">
        </form>
    </div>
    <!-- /Form -->
</div>

@endsection