@extends('admin.layouts.app')

@section('contents')
    @stack('css')
    <style>
        .btn-custom {
            padding: 6px 16px;
            font-size: 20px;
        }
    </style>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>{{ __('System Setting') }}</h3>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form id="userQuickForm" class="form-material form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <!-- Ensure CSRF token is correctly included -->
                    <div class="row">
                        <!-- Company Name -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Company Name (EN) <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-hospital"></i></span>
                                    </div>
                                    <input type="text" name="name" value="{{ old('name', $settings['name'] ?? '') }}"
                                        class="form-control" placeholder="Type Your Company Name Here" required>
                                </div>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Copyright -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="copy_right_text">Copyright Text <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-copyright"></i></span>
                                    </div>
                                    <input type="text" name="copy_right_text"
                                        value="{{ old('copy_right_text', $settings['copy_right_text'] ?? '') }}"
                                        class="form-control" placeholder="Enter copyright text" required>
                                </div>
                                @error('copy_right_text')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Company Email <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-at"></i></span>
                                    </div>
                                    <input type="email" name="email"
                                        value="{{ old('email', $settings['email'] ?? '') }}" class="form-control"
                                        placeholder="Type Your Company Email Here" required>
                                </div>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" name="phone"
                                        value="{{ old('phone', $settings['phone'] ?? '') }}" class="form-control"
                                        placeholder="Type Phone Number Here">
                                </div>
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="row">
                        <div class="col-md-12">
                            <label>
                                <h4>{{ __('Address') }}</h4>
                            </label>
                            <textarea name="address" class="form-control summernote" placeholder="Enter your address here">{{ old('address', $settings['address'] ?? '') }}</textarea>
                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Logo & Favicon -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Logo</label>
                                <input type="file" name="logo" class="dropify"
                                    data-default-file="{{ isset($settings['logo']) && file_exists(public_path('uploads/settings/' . $settings['logo']))
                                        ? asset('uploads/settings/' . $settings['logo'])
                                        : asset('uploads/profile.jpg') }}">
                                <small class="form-text text-muted">Max Size: 2MB | Format: png, jpg, jpeg</small>
                                @error('logo')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Favicon</label>
                                <input type="file" name="favicon" class="dropify"
                                    data-default-file="{{ isset($settings['favicon']) && file_exists(public_path('uploads/settings/' . $settings['favicon']))
                                        ? asset('uploads/settings/' . $settings['favicon'])
                                        : asset('uploads/profile.jpg') }}">
                                <small class="form-text text-muted">Max Size: 2MB | Format: png, jpg, jpeg, ico</small>
                                @error('favicon')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- Submit Buttons -->
                    <button type="submit" class="btn btn-primary btn-custom">Submit</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-danger btn-custom ml-2">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#userQuickForm').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('SystemSettingUpdate') }}",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('.btn-custom').prop('disabled', true).text('Saving...');
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message ||
                                'Settings updated successfully.');
                        } else {
                            toastr.error(response.message || 'Something went wrong.');
                        }
                        $('.btn-custom').prop('disabled', false).text('Submit');
                    },
                    error: function(xhr) {
                        $('.btn-custom').prop('disabled', false).text('Submit');
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, error) {
                                toastr.error(error[0]);
                            });
                        } else {
                            toastr.error('Unexpected error occurred.');
                        }
                    }
                });
            });
        });
    </script>
@endpush
