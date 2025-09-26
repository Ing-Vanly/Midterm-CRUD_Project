@extends('admin.layouts.app')
@section('contents')
    <div class="flex-1 c-content">
        <div class="d-flex flex-column h-100">
            <section class="content-header px-0">
                <div class="d-flex flex-row justify-content-between">
                    <a href="{{ route('user.index') }}" class="d-flex flex-row cursor-pointer"
                        style="text-decoration: none; color: black;">
                        <img src="{{ asset('images/chevron-left.png') }}" style="width: 25px; height: 35px;" class="mr-1">
                        <h3 class="title">{{ __('Edit User') }}</h3>
                    </a>
                </div>
            </section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>{{ __('Edit User') }}</h3>
                            </div>
                            <form id="userQuickForm" class="form-material form-horizontal"
                                action="{{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT') <!-- Adding the PUT method for the update -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-12 col-form-label">
                                                    <h4>{{ __('Name') }} <b class="ambitious-crimson">*</b></h4>
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-signature"></i></span>
                                                    </div>
                                                    <input class="form-control ambitious-form-loading " name="name"
                                                        value="{{ old('name', $user->name) }}" id="name" type="text"
                                                        placeholder="{{ __('Type Your Name Here') }}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="col-md-12 col-form-label">
                                                    <h4>{{ __('Gender') }}</h4>
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-venus-mars"></i></span>
                                                    </div>
                                                    <select class="form-control" name="gender" id="gender">
                                                        <option value="male"
                                                            {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>
                                                            Male
                                                        </option>
                                                        <option value="female"
                                                            {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>
                                                            Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="col-md-12 col-form-label">
                                                    <h4>{{ __('Age') }}</h4>
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><img
                                                                src="https://dentalclinic.eocambo.com/assets/icons/age.svg"
                                                                alt=""></span>
                                                    </div>
                                                    <input class="form-control ambitious-form-loading" name="age"
                                                        id="age" type="number" value="{{ old('age', $user->age) }}"
                                                        placeholder="{{ __('Age') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-12 col-form-label">
                                                    <h4>{{ __('Email') }} <b class="ambitious-crimson">*</b></h4>
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-at"></i></span>
                                                    </div>
                                                    <input class="form-control ambitious-form-loading " name="email"
                                                        value="{{ old('email', $user->email) }}" id="email"
                                                        type="email" placeholder="{{ __('Type Your Email Here') }}"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="col-md-12 col-form-label">
                                                    <h4>{{ __('Password') }} <b class="ambitious-crimson">*</b></h4>
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                                    </div>
                                                    <input class="form-control ambitious-form-loading " name="password"
                                                        id="password" type="password"
                                                        placeholder="{{ __('Type Your Password Here') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="col-md-12 col-form-label">
                                                    <h4>{{ __('Confirm Password') }} <b class="ambitious-crimson">*</b>
                                                    </h4>
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-fingerprint"></i></span>
                                                    </div>
                                                    <input class="form-control ambitious-form-loading "
                                                        name="password_confirmation" id="password_confirmation"
                                                        type="password"
                                                        placeholder="{{ __('Type Your Confirm Password Here') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- User For Dropdown -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-form-label">
                                                    <h4>{{ __('User Role') }} <b class="text-danger">*</b></h4>
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-users-cog"></i></span>
                                                    </div>
                                                    <select class="form-control @error('role_id') is-invalid @enderror"
                                                        name="role_id" id="role_id">
                                                        <option value="">{{ __('Select Role') }}</option>
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->id }}"
                                                                {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                                                {{ $role->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('role_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-md-12 col-form-label">
                                                    <h4>{{ __('Phone') }}</h4>
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                    </div>
                                                    <input class="form-control ambitious-form-loading" name="phone"
                                                        id="phone" type="text"
                                                        placeholder="{{ __('Type Phone Number Here') }}"
                                                        value="{{ old('phone', $user->phone) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-md-12 col-form-label">
                                                    <h4>{{ __('Status') }}</h4>
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-bell"></i></span>
                                                    </div>
                                                    <select class="form-control ambitious-form-loading"
                                                        required="required" name="status" id="status">
                                                        <option value="1"
                                                            {{ old('status', $user->status) == 1 ? 'selected' : '' }}>
                                                            Active</option>
                                                        <option value="0"
                                                            {{ old('status', $user->status) == 0 ? 'selected' : '' }}>
                                                            Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="col-md-12 col-form-label">
                                                <h4>{{ __('Photo') }}</h4>
                                            </label>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="file" name="image" id="image" class="dropify"
                                                        data-default-file="{{ $user->image ? asset('uploads/users/' . $user->image) : '' }}"
                                                        data-show-loader="false">
                                                    <input type="hidden" name="remove_image" id="remove_image"
                                                        value="0">
                                                    @error('image')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">
                                                    <h4>{{ __('Address') }}</h4>
                                                </label>
                                                <textarea name="address" id="address" class="form-control summernote" rows="3">{!! $user->address !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Add the rest of the fields like Email, Password, etc. in similar fashion -->
                                    <div class="row">

                                    </div>

                                    <div class="card-footer">
                                        <a href="{{ route('user.index') }}"
                                            class="btn btn-danger text-uppercase float-left">
                                            <i class="fas fa-backward"></i>
                                            {{ __('Cancel') }}</a>
                                        <button type="submit"
                                            class="btn btn-outline btn-info text-uppercase float-right"> <i
                                                class="fas fa-refresh"></i> {{ __('Update') }}</button>
                                    </div>
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
        // Handle role changes and quill editor setup like in the create page
        document.addEventListener('DOMContentLoaded', function() {
            const roleForSelect = document.getElementById('user_for');
            const staffBlock = document.getElementById('staff_block');
            const userBlock = document.getElementById('user_block');
            var selectStaff = document.getElementById('staff_roles');
            var selectUser = document.getElementById('user_roles');

            function handleRoleChange() {
                if (roleForSelect.value === 'general_user') {
                    staffBlock.style.display = 'none';
                    userBlock.style.display = 'block';
                    selectStaff.disabled = true;
                    selectUser.disabled = false;
                } else if (roleForSelect.value === 'system_user') {
                    staffBlock.style.display = 'block';
                    userBlock.style.display = 'none';
                    selectStaff.disabled = false;
                    selectUser.disabled = true;
                }
            }

            handleRoleChange();
            roleForSelect.addEventListener('change', handleRoleChange);
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Quill editor
            var quill = new Quill('#input_address', {
                theme: 'snow',
                placeholder: '{{ __('Enter your address here') }}...',
            });
            var oldAddress = @json(old('address', $user->address));
            quill.root.innerHTML = oldAddress;
            document.querySelector('#userQuickForm').addEventListener('submit', function() {
                document.querySelector('#address').value = quill.root.innerHTML;
            });
        });
        $('.dropify').dropify();

        $('#image').on('dropify.afterClear', function(event, element) {
            $('#remove_image').val('1');
        });
    </script>
@endpush
