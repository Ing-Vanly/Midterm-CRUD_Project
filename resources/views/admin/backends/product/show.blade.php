@extends('admin.layouts.app')

@section('contents')
<section class="content-header px-0">
    <div class="d-flex flex-row justify-content-between align-items-center">
        <a href="{{ route('product.index') }}" class="d-flex flex-row cursor-pointer" style="text-decoration: none; color: black;">
            <img src="{{ asset('images/chevron-left.png') }}" style="width: 25px; height: 35px;" class="mr-1" alt="Back">
            <h3 class="title">{{ __('Product Details') }}</h3>
        </a>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card">

            <div class="card-body">
                <div class="row">

                    {{-- Product Image --}}
                    <div class="col-md-4 text-center">
                        @if($product->image)
                            <img src="{{ asset('uploads/products/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded mb-3" style="max-height: 300px;">
                        @else
                            <div class="border rounded p-5 text-muted">
                                {{ __('No Image Available') }}
                            </div>
                        @endif
                    </div>

                    {{-- Product Details --}}
                    <div class="col-md-8">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <td>{{ $product->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Category') }}</th>
                                    <td>{{ $product->category->name ?? __('N/A') }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Price') }}</th>
                                    <td>${{ number_format($product->price, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Status') }}</th>
                                    <td>
                                        <span class="badge badge-{{ $product->status ? 'success' : 'danger' }}">
                                            {{ $product->status ? __('Active') : __('Inactive') }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('Description') }}</th>
                                    <td>{!! nl2br(e($product->description)) !!}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Created At') }}</th>
                                    <td>{{ $product->created_at->format('d M Y, h:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Updated At') }}</th>
                                    <td>{{ $product->updated_at->format('d M Y, h:i A') }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> {{ __('Edit Product') }}
                        </a>
                        <a href="{{ route('product.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> {{ __('Back to List') }}
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
@endsection
