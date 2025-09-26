@extends('admin.layouts.app')
@section('contents')
    <div class="flex-1 c-content">
        <div class="d-flex flex-column h-100">
            <section class="content-header px-0">
                <div class="d-flex flex-row justify-content-between">
                    <a href="{{ route('user.index') }}" class="d-flex flex-row cursor-pointer"
                        style="text-decoration: none; color: black;">
                        <img src="{{ asset('images/chevron-left.png') }}" style="width: 25px; height: 35px;" class="mr-1">
                        <h3 class="title">{{ __('View User') }}</h3>
                    </a>
                </div>
            </section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>{{ __('View User') }}</h3>
                            </div>

                            <form id="userQuickForm" class="form-material form-horizontal" action="#" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="card-body">
                                    {{-- Row 1 --}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">
                                                    <h4>{{ __('Name') }} <b class="ambitious-crimson">*</b></h4>
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-signature"></i></span>
                                                    </div>
                                                    <input class="form-control ambitious-form-loading" name="name"
                                                        id="name" type="text" value="{{ old('name', $user->name) }}"
                                                        placeholder="{{ __('Type Your Name Here') }}" required disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="col-form-label">
                                                    <h4>{{ __('Gender') }}</h4>
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-venus-mars"></i></span>
                                                    </div>
                                                    <select class="form-control" name="gender" id="gender" disabled>
                                                        <option value="male"
                                                            {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>
                                                            Male</option>
                                                        <option value="female"
                                                            {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>
                                                            Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="col-form-label">
                                                    <h4>{{ __('Age') }}</h4>
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <img src="https://dentalclinic.eocambo.com/assets/icons/age.svg"
                                                                alt="">
                                                        </span>
                                                    </div>
                                                    <input class="form-control ambitious-form-loading" name="age"
                                                        id="age" type="number" value="{{ old('age', $user->age) }}"
                                                        placeholder="{{ __('Age') }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Row 2 --}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">
                                                    <h4>{{ __('Email') }} <b class="ambitious-crimson">*</b></h4>
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-at"></i></span>
                                                    </div>
                                                    <input class="form-control ambitious-form-loading" name="email"
                                                        id="email" type="email"
                                                        value="{{ old('email', $user->email) }}"
                                                        placeholder="{{ __('Type Your Email Here') }}" required disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="col-form-label">
                                                    <h4>{{ __('Password') }} <b class="ambitious-crimson">*</b></h4>
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                                    </div>
                                                    <input class="form-control ambitious-form-loading" name="password"
                                                        id="password" type="password"
                                                        placeholder="{{ __('Type Your Password Here') }}" required
                                                        disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="col-form-label">
                                                    <h4>{{ __('Confirm Password') }} <b class="ambitious-crimson">*</b>
                                                    </h4>
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-fingerprint"></i></span>
                                                    </div>
                                                    <input class="form-control ambitious-form-loading"
                                                        name="password_confirmation" id="password_confirmation"
                                                        type="password"
                                                        placeholder="{{ __('Type Your Confirm Password Here') }}" required
                                                        disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Row 3 --}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-form-label">
                                                    <h4>{{ __('User Role') }}</h4>
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-users-cog"></i></span>
                                                    </div>
                                                    <select class="form-control ambitious-form-loading" name="role_id"
                                                        id="role_id" disabled>
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->id }}"
                                                                {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                                {{ $role->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-form-label">
                                                    <h4>{{ __('Phone') }}</h4>
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                    </div>
                                                    <input class="form-control ambitious-form-loading" name="phone"
                                                        id="phone" type="text"
                                                        value="{{ old('phone', $user->phone) }}"
                                                        placeholder="{{ __('Type Phone Number Here') }}" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-form-label">
                                                    <h4>{{ __('Status') }}</h4>
                                                </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-bell"></i></span>
                                                    </div>
                                                    <select class="form-control ambitious-form-loading" name="status"
                                                        id="status" disabled>
                                                        <option value="1"
                                                            {{ old('status', $user->status) == '1' ? 'selected' : '' }}>
                                                            Active</option>
                                                        <option value="0"
                                                            {{ old('status', $user->status) == '0' ? 'selected' : '' }}>
                                                            Inactive</option>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">
                                                    <h4>{{ __('Photo') }}</h4>
                                                </label>
                                                <input type="file" name="image" id="image" class="dropify"
                                                    data-default-file="{{ $user->image ? asset('uploads/users/' . $user->image) : '' }}"
                                                    data-show-loader="false" disabled>
                                                @error('image')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">
                                                    <h4>{{ __('Address') }}</h4>
                                                </label>
                                                <textarea name="address" id="address" class="form-control summernote" rows="3" disabled>{{ $user->address }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div> {{-- End card-body --}}
                                <div class="card-footer">
                                    <a href="{{ route('user.index') }}" class="btn btn-danger text-uppercase float-left">
                                        <i class="fas fa-backward"></i> {{ __('Cancel') }}
                                    </a>
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
            const roleForSelect = document.getElementById('user_for');
            const staffBlock = document.getElementById('staff_block');
            const userBlock = document.getElementById('user_block');
            const selectStaff = document.getElementById('staff_roles');
            const selectUser = document.getElementById('user_roles');

            function handleRoleChange() {
                if (roleForSelect && roleForSelect.value === 'general_user') {
                    staffBlock.style.display = 'none';
                    userBlock.style.display = 'block';
                    selectStaff.disabled = true;
                    selectUser.disabled = false;
                } else if (roleForSelect && roleForSelect.value === 'system_user') {
                    staffBlock.style.display = 'block';
                    userBlock.style.display = 'none';
                    selectStaff.disabled = false;
                    selectUser.disabled = true;
                }
            }

            if (roleForSelect) {
                handleRoleChange();
                roleForSelect.addEventListener('change', handleRoleChange);
            }
        });
    </script>
@endpush
