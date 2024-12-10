@extends('admin.master')

@section('content')
    <div class="admin-content-container">
        <h3 class="admin-heading">update brand</h3>

        <div class="row">
            <!-- Form -->
            <form id="updateBrand" action="{{ route('brand.update', $brand->id) }}" class="add-post-form col-md-6"
                method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="brand_id" value="{{ $brand->id }}" />
                <div class="form-group">
                    <label>Brand Title</label>
                    <input type="text" name="brand_name" class="form-control brand_name" value="{{ $brand->brand }}"
                        placeholder="Brand Name" required />
                </div>
                <div class="form-group">
                    <label>Brand Category</label>

                    <select name="brand_cat" class="form-control brand_category">
                        <option value="" selected disabled>Select Category</option>
                        @foreach ($category as $categories)
                            <option
                                @if ($categories->id == $brand->brand_cat) {{ 'selected' }}
                        @else
                        {{ '' }} @endif
                                value="{{ $categories->id }}">{{ $categories->sub_cat_name }}
                            </option>
                        @endforeach

                    </select>
                </div>
                <input type="submit" name="submit" class="btn add-new" value="Update" />
            </form>
            <!-- /Form -->
        </div>

        <!-- <div class="not-found">!!! Result Not Found !!!</div> -->

    </div>
@endsection
