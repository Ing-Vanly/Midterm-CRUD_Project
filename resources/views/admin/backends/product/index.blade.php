@extends('admin.layouts.app')
@section('contents')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>{{ __('Product Management') }}</h3>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('product.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus-circle"></i> {{ __('Add New Product') }}
                </a>
            </div>
        </div>
    </div>
</section>

<section class="content">
   @include('admin.backends.product.table')
</section>

@push('js')
<script>
    // Delete with SweetAlert and AJAX
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        var btn = $(this);
        Swal.fire({
            title: '{{ __("Are you sure?") }}',
            text: '{{ __("You won\'t be able to revert this!") }}',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '{{ __("Yes, delete it!") }}',
            cancelButtonText: '{{ __("No, cancel!") }}',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                var form = $('.form-delete-' + btn.data('id'));
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        if(response.status) {
                            toastr.success(response.msg);
                            location.reload();
                        } else {
                            toastr.error(response.msg);
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
@endsection
