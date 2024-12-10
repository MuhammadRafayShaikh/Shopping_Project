@extends('admin.master')
@section('content')

    <div class="admin-content-container">
        <h2 class="admin-heading">All SubCategory</h2>
        <a class="add-new pull-right" href="{{ route('subcategory.create') }}">Add New</a>
        @if (session('subcategory'))
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <th class="text-center text-success" colspan="3">
                        {{ session('subcategory') }}
                    </th>
                </thead>
            </table>
        @endif
        @if ($subcategory->count() > 0)
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Show in Header</th>
                    <th>Show in Footer</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($subcategory as $subcategories)
                        <tr>
                            <td>{{ $subcategories->sub_cat_name }}</td>
                            <td>{{ $subcategories->category->category_name }}</td>
                            <td>
                                <input type="checkbox" class="toggle-checkbox showCat_Header"
                                    data-id="{{ $subcategories->id }}"
                                    {{ $subcategories->s_i_header == 1 ? 'checked' : '' }} />
                            </td>
                            <td>
                                <input type="checkbox" class="toggle-checkbox showCat_Footer"
                                    data-id="{{ $subcategories->id }}"
                                    {{ $subcategories->s_i_footer == 1 ? 'checked' : '' }} />
                            </td>
                            <td>
                                <a href="{{ route('subcategory.edit', $subcategories->id) }}"><i class="fa fa-edit"></i></a>
                                <a class="delete_subCategory" href="javascript:void();"
                                    data-id="{{ $subcategories->id }}"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

            <div class="col-md-12">
                <div class="pagination-outer">
                    <ul class="pagination">
                        @if (!$subcategory->onFirstPage())
                            <li><a href="{{ $subcategory->previousPageUrl() }}" class="page-link">Prev</a></li>
                        @endif

                        @foreach ($subcategory->links()->elements as $element)
                            @if (is_string($element))
                                <li class="disabled"><span>{{ $element }}</span></li>
                            @endif

                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $subcategory->currentPage())
                                        <li class="active"><a class="page-link">{{ $page }}</a></li>
                                    @else
                                        <li><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach


                        @if ($subcategory->hasMorePages())
                            <li><a class="page-link" href="{{ $subcategory->nextPageUrl() }}">Next</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        @else
            <div class="not-found">!!! No Sub Categories Available !!!</div>
        @endif
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('change', '.showCat_Header', function() {
            var id = $(this).data('id');
            var checked = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: "{{ route('updateHeaderStatus') }}",
                method: 'POST',
                data: {
                    id: id,
                    s_i_header: checked,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert(response.message);
                }
            });
        });

        $(document).on('change', '.showCat_Footer', function() {
            var id = $(this).data('id');
            var checked = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: "{{ route('updateFooterStatus') }}",
                method: 'POST',
                data: {
                    id: id,
                    s_i_footer: checked,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert(response.message);
                }
            });
        });
    </script>


@endsection
