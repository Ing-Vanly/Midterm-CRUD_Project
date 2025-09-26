@extends('admin.layouts.app')

@section('contents')
<section class="content-header px-0">
    <div class="d-flex flex-row justify-content-between">
        <a href="{{ route('product.index') }}" class="d-flex flex-row cursor-pointer" style="text-decoration: none; color: black;">
            <img src="{{ asset('images/chevron-left.png') }}" style="width: 25px; height: 35px;" class="mr-1" alt="Back">
            <h3 class="title">{{ __('Edit Product') }}</h3>
        </a>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">{{ __('Product Name') }} <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', $product->name) }}"
                                class="form-control"
                                required
                                placeholder="{{ __('Enter product name') }}"
                            >
                        </div>

                        <div class="form-group col-md-6">
                            <label for="category_id">{{ __('Category') }} <span class="text-danger">*</span></label>
                            <select
                                name="category_id"
                                id="category_id"
                                class="form-control"
                                required
                            >
                                <option value="">{{ __('Select Category') }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="price">{{ __('Price') }} <span class="text-danger">*</span></label>
                            <input
                                type="number"
                                id="price"
                                name="price"
                                value="{{ old('price', $product->price) }}"
                                step="0.01"
                                min="0"
                                class="form-control"
                                required
                                placeholder="{{ __('Enter price') }}"
                            >
                        </div>

                        <div class="form-group col-md-6">
                            <label for="status">{{ __('Status') }} <span class="text-danger">*</span></label>
                            <select
                                id="status"
                                name="status"
                                class="form-control"
                                required
                            >
                                <option value="1" {{ old('status', $product->status) == '1' ? 'selected' : '' }}>
                                    {{ __('Active') }}
                                </option>
                                <option value="0" {{ old('status', $product->status) == '0' ? 'selected' : '' }}>
                                    {{ __('Inactive') }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><h4>{{ __('Photo') }}</h4></label>
                        <input
                            type="file"
                            name="image"
                            id="image"
                            class="dropify"
                            data-show-loader="false"
                            data-default-file="{{ $product->image ? asset('uploads/products/' . $product->image) : '' }}"
                            placeholder="{{ __('Upload product photo') }}"
                        >
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">{{ __('Description') }}</label>
                        <textarea
                            id="description"
                            name="description"
                            rows="4"
                            class="form-control"
                            placeholder="{{ __('Enter product description') }}"
                        >{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('product.index') }}" class="btn btn-danger text-uppercase float-left">
                        <i class="fas fa-backward"></i> {{ __('Cancel') }}
                    </a>
                    <button type="submit" class="btn btn-outline btn-primary text-uppercase float-right">
                        <i class="ri-save-line"></i> {{ __('Update') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
