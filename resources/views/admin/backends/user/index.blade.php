@extends('admin.layouts.app')
@section('contents')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>{{ __('User Management') }}</h3>
                </div>
                <div class="col-sm-6" style="margin-top: -5px">
                    <h3 style="position: absolute; right: 0; color: white;">
                        <a href="{{ route('user.create') }}" class="btn btn-outline btn-primary">+
                            {{ __('Add User') }}</a>
                        <span class="pull-right"></span>
                    </h3>
                </div>
            </div>
        </div>
    </section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('User Management') }}</h3>
                        <div class="card-tools">

                            <button class="btn btn-primary" data-toggle="collapse" href="#filter"><i
                                    class="fas fa-filter"></i>
                                {{ __('Filter') }}</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="filter" class="mb-2 collapse">
                            <div class="card-body border rounded">
                                <form action="" method="get" role="form" autocomplete="off">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>{{ __('Name') }}</label>
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="{{ __('Name') }}" value="{{ request()->name }}">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>{{ __('Gender') }}</label>
                                                <select class="form-control" name="gender">
                                                    <option value="">{{ __('All') }}</option>
                                                    <option value="male"
                                                        {{ request()->gender == 'male' ? 'selected' : '' }}>Male
                                                    </option>
                                                    <option value="female"
                                                        {{ request()->gender == 'female' ? 'selected' : '' }}>
                                                        Female</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label>{{ __('Status') }}</label>
                                                <select class="form-control" name="status">
                                                    <option value="">{{ __('All') }}</option>
                                                    <option value="active"
                                                        {{ request()->status == 'active' ? 'selected' : '' }}>
                                                        Active</option>
                                                    <option value="inactive"
                                                        {{ request()->status == 'inactive' ? 'selected' : '' }}>
                                                        Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary"
                                        style="padding: 5px 13px; font-size:20px;">
                                        <i class="ri-search-line"></i> {{ __('Search') }}</button>
                                    <a href="{{ route('user.index') }}" class=" btn btn-danger"
                                        style="padding: 5px 17px; font-size:20px;">
                                        <i class="ri-loop-right-line"></i>
                                        {{ __('Reset') }}
                                    </a>
                                </form>
                            </div>
                        </div>
                        @include('admin.backends.user.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
@push('js')
    <script>
        $('.btn_add').click(function(e) {
            var tbody = $('.tbody');
            var numRows = tbody.find("tr").length;
            $.ajax({
                type: "get",
                url: window.location.href,
                data: {
                    "key": numRows
                },
                dataType: "json",
                success: function(response) {
                    $(tbody).append(response.tr);
                }
            });
        });

        $(document).on('click', '.btn-edit', function() {
            $("div.modal_form").load($(this).data('href'), function() {

                $(this).modal('show');

            });
        });

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
        // Update Status
        $('input.status').on('change', function() {
            var usertId = $(this).data('id');

            $.ajax({
                type: "POST",
                url: "{{ route('user.update_status') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": usertId,
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == 1) {
                        toastr.success(response.msg);
                    } else {
                        toastr.error(response.msg);
                    }
                },
                error: function() {
                    toastr.error('An error occurred while updating the status.');
                }
            });
        });
    </script>
@endpush
