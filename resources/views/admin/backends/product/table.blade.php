<div class="container-fluid table-wrapper">
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Image') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Category') }}</th>
                        <th>{{ __('Price') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $product)
                        <tr>
                            {{-- Use pagination-aware index --}}
                            <td>{{ $products->firstItem() + $key }}</td>

                            <td>
                                @if ($product->image)
                                    <img src="{{ asset('uploads/products/' . $product->image) }}"
                                        alt="{{ $product->name }}" width="50" height="50" class="rounded-circle">
                                @else
                                    <span>No Image</span>
                                @endif
                            </td>

                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name ?? 'N/A' }}</td>
                            <td>${{ number_format($product->price, 2) }}</td>
                            <td>{{ Str::limit($product->description, 50) }}</td>
                            <td>
                                <span class="badge badge-{{ $product->status ? 'success' : 'danger' }}">
                                    {{ $product->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('product.show', $product->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> {{ __('Show') }}
                                </a>

                                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                                </a>

                                <form method="POST" action="{{ route('product.destroy', $product->id) }}"
                                    class="d-inline-block form-delete-{{ $product->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm btn-delete"
                                        data-id="{{ $product->id }}">
                                        <i class="fas fa-trash-alt"></i> {{ __('Delete') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination Info and Links --}}

            <div class="row align-items-center" style="margin-top: 15px;">
                <div class="col-sm-6">
                    {{ __('Showing') }} {{ $products->firstItem() }} {{ __('to') }} {{ $products->lastItem() }}
                    {{ __('of') }} {{ $products->total() }} {{ __('entries') }}
                </div>
                <nav aria-label="Page navigation example" class="d-flex justify-content-end" style="margin-top: -25px;">
                    <ul class="pagination">

                        {{-- Previous Page Link --}}
                        <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $products->previousPageUrl() ?? '#' }}" tabindex="-1">
                                {{ __('Previous') }}
                            </a>
                        </li>

                        {{-- Pagination Elements --}}
                        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $products->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        {{-- Next Page Link --}}
                        <li class="page-item {{ !$products->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $products->nextPageUrl() ?? '#' }}">
                                {{ __('Next') }}
                            </a>
                        </li>

                    </ul>
                </nav>

            </div>
        </div>
    </div>
</div>
