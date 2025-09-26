@extends('admin.layouts.app')
@section('contents')
    <div class="flex-1 c-content">
        <div class="d-flex flex-column h-100">
            <section class="content-header px-0">
                <div class="d-flex flex-row justify-content-between">
                    <a href="{{ route('dashboard') }}" class="d-flex flex-row cursor-pointer"
                        style="text-decoration: none; color: black;">
                        <img src="{{ asset('images/chevron-left.png') }}" style="width: 25px; height: 35px;" class="mr-1">
                        <h3 class="title">{{ __('Edit Profile') }}</h3>
                    </a>
                </div>
            </section>

            <div class="container-fluid">
                <div class="row flex-1">
                    <div class="col-12">
                        <div class="card">
                            <form id="userQuickForm" action="{{ route('profile.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                {{-- @method('PUT') --}}
                                <div class="card-body" style="background: white; border-radius: 15px;">
                                    <!-- Name -->
                                    <div class="form-group row">
                                        <label class="col-md-3 ambitious-center">
                                            <h4>{{ __('Name') }} <b class="ambitious-crimson">*</b></h4>
                                        </label>
                                        <div class="col-md-8">
                                            <input class="form-control ambitious-form-loading" name="name" id="name"
                                                value="" type="text" placeholder="Type Your Name Here" required>
                                        </div>
                                    </div>
                                    <!-- Email -->
                                    <div class="form-group row">
                                        <label class="col-md-3 ambitious-center">
                                            <h4>{{ __('Email') }} <b class="ambitious-crimson">*</b></h4>
                                        </label>
                                        <div class="col-md-8">
                                            <input class="form-control ambitious-form-loading" name="email" id="email"
                                                value="" type="email" placeholder="Type Your Email Here" required>
                                        </div>
                                    </div>
                                    <!-- Photo -->
                                    <div class="form-group row">
                                        <label class="col-md-3 ambitious-center">
                                            <h4>{{ __('Photo') }} <b class="ambitious-crimson">*</b></h4>
                                        </label>
                                        <div class="col-md-6">
                                            {{ __('
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        Max Dimension: 200 x 200, Max Size: 100kb, Allowed format: png') }}
                                            <input type="file" name="image" id="image" class="dropify"
                                                data-show-loader="false" data-default-file="" />
                                            <small
                                                class="form-text text-muted">{{ __('Leave Blank For Remain Unchanged') }}</small>
                                        </div>
                                    </div>

                                    <!-- Phone -->
                                    <div class="form-group row">
                                        <label class="col-md-3 ambitious-center">
                                            <h4>{{ __('Phone') }}</h4>
                                        </label>
                                        <div class="col-md-8">
                                            <input class="form-control ambitious-form-loading" name="phone" value=""
                                                id="phone" type="text"
                                                placeholder="{{ __('Type Your Number Here') }}">
                                        </div>
                                    </div>
                                    <!-- Address -->
                                    <div class="form-group row" style="margin-bottom: 30px;">
                                        <label class="col-md-3 ambitious-center">
                                            <h4>{{ __('Address') }}</h4>
                                        </label>
                                        <div class="col-md-8">
                                            <textarea name="address" class="form-control summernote" placeholder="{{ __('Enter your address here') }}">{{ old('address') }}</textarea>
                                        </div>
                                    </div>


                                    <!-- Password -->
                                    <div class="form-group row" style="margin-top: 65px;">
                                        <label class="col-md-3 ambitious-center">
                                            <h4>{{ __('Password') }} <b class="ambitious-crimson">*</b></h4>
                                        </label>
                                        <div class="col-md-8">
                                            <input class="form-control ambitious-form-loading" name="new-password"
                                                id="new-password" type="password"
                                                placeholder="{{ __('Type Your Password Here') }}">
                                            <small
                                                class="form-text text-muted">{{ __('Leave Blank For Remain Unchanged') }}</small>
                                        </div>
                                    </div>


                                    <!-- Confirm Password -->
                                    <div class="form-group row">
                                        <label class="col-md-3 ambitious-center">
                                            <h4>{{ __('Confirm Password') }} <b class="ambitious-crimson">*</b></h4>
                                        </label>
                                        <div class="col-md-8">
                                            <input class="form-control ambitious-form-loading"
                                                name="new-password_confirmation" type="password"
                                                placeholder="{{ __('Type Your Confirm Password Here') }}">
                                            <small
                                                class="form-text text-muted">{{ __('Leave Blank For Remain Unchanged') }}</small>
                                        </div>
                                    </div>
                                    <!-- Footer -->
                                    <div class="card-footer" style="background: rgb(245, 244, 244); border-radius: 0px;">

                                        <button type="submit" class="btn btn-primary float-right">
                                            <i class="fas fa-sync-alt"></i> {{ __('Update') }}
                                        </button>
                                        <a href="{{ route('dashboard') }}" class="btn btn-danger float-left">
                                            <i class="fas fa-backward"></i> {{ __('Cancel') }}
                                        </a>
                                    </div>
                            </form>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('js')
    <script></script>
@endpush
