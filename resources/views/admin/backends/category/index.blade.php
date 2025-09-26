@extends('admin.layouts.app')
@section('contents')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>{{ __('Category') }}</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#createCategoryModal">
                        <i class="fa fa-plus-circle"></i> {{ __('Add New Category') }}
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid table-wrapper">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="">
                            <tr>
                                <th>{{ __('ID') }} </th>
                                <th>{{ __('Name') }} </th>
                                <th>{{ __('Description') }} </th>
                                <th>{{ __('Status') }} </th>
                                <th>{{ __('Actions') }} </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $key => $category)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>
                                        <span class="badge badge-{{ $category->status ? 'success' : 'danger' }}">
                                            {{ $category->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary btn-edit"
                                            data-id="{{ $category->id }}" data-name="{{ $category->name }}"
                                            data-description="{{ $category->description }}"
                                            data-status="{{ $category->status }}" data-toggle="modal"
                                            data-target="#editCategoryModal">
                                            <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                                        </button>

                                        <form method="POST" action="{{ route('category.destroy', $category->id) }}"
                                            class="d-inline-block form-delete-{{ $category->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm btn-delete"
                                                data-id="{{ $category->id }}"
                                                data-href="{{ route('category.destroy', $category->id) }}">
                                                <i class="fas fa-trash-alt"></i> {{ __('Delete') }}
                                            </button>
                                        </form>

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </section>

    <!-- Create Modal -->
    <div class="modal fade" id="createCategoryModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('category.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create Category</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" id="editCategoryForm">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Category</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input name="name" id="edit_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" id="edit_description" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" id="edit_status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-warning">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        // Populate edit form
        $('.btn-edit').on('click', function() {
            const id = $(this).data('id');
            $('#editCategoryForm').attr('action', '{{ url('category') }}/' + id);
            $('#edit_name').val($(this).data('name'));
            $('#edit_description').val($(this).data('description'));
            $('#edit_status').val($(this).data('status'));
        });

        // SweetAlert delete
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();

            const Confirmation = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success m-2',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });

            // SweetAlert2 Confirmation Dialog
            Confirmation.fire({
                title: '{{ __('Are you sure?') }}',
                text: @json(__('You won\'t be able to revert this!')),
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '{{ __('Yes, delete it!') }}',
                cancelButtonText: '{{ __('No, cancel!') }}',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = $(`.form-delete-${$(this).data('id')}`);
                    var data = form.serialize(); // Serialize the form data, including _method=DELETE

                    $.ajax({
                        type: 'POST', // Using POST for AJAX, but sending DELETE via _method spoofing
                        url: form.attr('action'), // Use the form action URL for the AJAX request
                        data: data, // Send the form data including CSRF token and _method
                        success: function(response) {
                            if (response.status == 1) {
                                location.reload();
                                toastr.success(response.msg); // Show success message
                            } else {
                                toastr.error(response.msg); // Show error message
                            }
                        },
                        error: function() {
                            toastr.error('An error occurred while deleting.');
                        }
                    });
                }
            });
        });
    </script>
@endpush
