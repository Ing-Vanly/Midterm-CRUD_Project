@extends('admin.layouts.app')

@section('contents')
    <div class="flex-1 c-content">
        <div class="d-flex flex-column h-100">
            <section class="content-header px-0">
                <div class="d-flex flex-row justify-content-between">
                    <a href="{{ route('user.index') }}" class="d-flex flex-row cursor-pointer"
                        style="text-decoration: none; color: black;">
                        <img src="{{ asset('images/chevron-left.png') }}" style="width: 25px; height: 35px;" class="mr-1">
                        <h3 class="title">{{ __('Create User') }}</h3>
                    </a>
                </div>
            </section>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>{{ __('Create User') }}</h3>
                            </div>
                            <form id="userQuickForm" action="{{ route('user.store') }}" method="POST"
                                enctype="multipart/form-data" class="form-material form-horizontal">
                                @csrf

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="card-body">
                                    <div class="row">
                                        {{-- Name --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    <h4>{{ __('Name') }} <b class="text-danger">*</b></h4>
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-signature"></i></span>
                                                    </div>
                                                    <input type="text" name="name" class="form-control"
                                                        placeholder="{{ __('Type Your Name Here') }}"
                                                        value="{{ old('name') }}">
                                                </div>
                                                @error('name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Gender --}}
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>
                                                    <h4>{{ __('Gender') }}</h4>
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-venus-mars"></i></span>
                                                    </div>
                                                    <select name="gender" class="form-control">
                                                        <option value="">-- {{ __('Select') }} --</option>
                                                        <option value="male"
                                                            {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                                        <option value="female"
                                                            {{ old('gender') == 'female' ? 'selected' : '' }}>Female
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Age --}}
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>
                                                    <h4>{{ __('Age') }}</h4>
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><img
                                                                src="https://dentalclinic.eocambo.com/assets/icons/age.svg"
                                                                alt=""></span>
                                                    </div>
                                                    <input type="number" name="age" class="form-control"
                                                        placeholder="{{ __('Age') }}" value="{{ old('age') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- Email --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>
                                                    <h4>{{ __('Email') }} <b class="text-danger">*</b></h4>
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-at"></i></span>
                                                    </div>
                                                    <input type="email" name="email" class="form-control"
                                                        placeholder="{{ __('Type Your Email Here') }}"
                                                        value="{{ old('email') }}">
                                                </div>
                                                @error('email')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Password --}}
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>
                                                    <h4>{{ __('Password') }} <b class="text-danger">*</b></h4>
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                                    </div>
                                                    <input type="password" name="password" id="password"
                                                        class="form-control"
                                                        placeholder="{{ __('Type Your Password Here') }}">
                                                </div>
                                                @error('password')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Confirm Password --}}
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>
                                                    <h4>{{ __('Confirm Password') }} <b class="text-danger">*</b></h4>
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-fingerprint"></i></span>
                                                    </div>
                                                    <input type="password" name="password_confirmation"
                                                        id="password_confirmation" class="form-control"
                                                        placeholder="{{ __('Type Your Confirm Password Here') }}">
                                                </div>
                                                <span id="password-error" class="text-danger"
                                                    style="display: none;">{{ __('Passwords do not match') }}!</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- Role --}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>
                                                    <h4>{{ __('User Role') }}</h4>
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-users-cog"></i></span>
                                                    </div>
                                                    <select name="role_id" class="form-control">
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->id }}"
                                                                {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                                                {{ $role->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('role_id')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Phone --}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>
                                                    <h4>{{ __('Phone') }}</h4>
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                    </div>
                                                    <input type="text" name="phone" class="form-control"
                                                        placeholder="{{ __('Type Phone Number Here') }}"
                                                        value="{{ old('phone') }}">
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Status --}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>
                                                    <h4>{{ __('Status') }}</h4>
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-bell"></i></span>
                                                    </div>
                                                    <select name="status" class="form-control" required>
                                                        <option value="1"
                                                            {{ old('status', '1') == '1' ? 'selected' : '' }}>Active
                                                        </option>
                                                        <option value="0"
                                                            {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {{-- Photo --}}
                                        <div class="col-md-6">
                                            <label>
                                                <h4>{{ __('Photo') }}</h4>
                                            </label>
                                            <input type="file" name="image" id="image" class="dropify"
                                                data-show-loader="false">
                                            @error('image')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        {{-- Address --}}
                                        <div class="col-md-6">
                                            <label>
                                                <h4>{{ __('Address') }}</h4>
                                            </label>
                                            <textarea name="address" class="form-control summernote" placeholder="{{ __('Enter your address here') }}">{{ old('address') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <a href="{{ route('user.index') }}" class="btn btn-danger text-uppercase float-left">
                                        <i class="fas fa-backward"></i> {{ __('Cancel') }}
                                    </a>
                                    <button type="submit" class="btn btn-outline btn-primary text-uppercase float-right">
                                        <i class="ri-save-line"></i> {{ __('Submit') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('password_confirmation');
            const errorText = document.getElementById('password-error');

            confirmPassword.addEventListener('input', function() {
                if (confirmPassword.value !== password.value) {
                    errorText.style.display = 'block';
                } else {
                    errorText.style.display = 'none';
                }
            });

            $('.dropify').dropify();
            $('.summernote').summernote();
        });
    </script>
@endpush
