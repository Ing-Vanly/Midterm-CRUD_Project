<style>
    tr.deleted-user {
        color: #aaa;
    }

    tr.deleted-user td {
        position: relative;
        background-color: #fff;
    }

    tr.deleted-user td::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        width: 100%;
        border-bottom: 1px solid #888;
        z-index: 1;
    }

    tr.deleted-user td * {
        position: relative;
        z-index: 2;
        opacity: 0.6;
    }
</style>


<table class="table table-hover table-wrapper" id="laravel_datatable1" data-ordering="false">
    <thead>
        <tr>
            <th>{{ __('Id') }}</th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Gender') }}</th>
            <th>{{ __('Role') }}</th>
            <th>{{ __('Register Date') }}</th>
            <th>{{ __('Status') }}</th>
            <th data-orderable="false">{{ __('Action') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr class="{{ $user->deleted_at ? 'deleted-user' : '' }}">
                <td>{{ $loop->iteration }}</td>
                <td>
                    <img src="{{ asset('uploads/users/' . ($user->image ?? 'default_image.png')) }}" alt="User Image"
                        width="50" height="50" class="rounded-circle">
                    {{ $user->name }}
                </td>
                <td>{{ ucfirst($user->gender ?? 'N/A') }}</td>
                <td>{{ optional($user->roles->first())->name ?? 'No role' }}</td>

                <td>{{ $user->created_at->format('Y-m-d') }}</td>

                <td>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input switcher_input status"
                            id="status_{{ $user->id }}" data-id="{{ $user->id }}"
                            {{ $user->status == 1 ? 'checked' : '' }} name="status">
                        <label class="custom-control-label" for="status_{{ $user->id }}"></label>
                    </div>
                </td>
                <td>
                    <a href="{{ route('user.show', $user->id) }}" class="btn btn-sm btn-info">
                        <i class="fa fa-eye"></i> {{ __('View') }}
                    </a>
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                    </a>
                    <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                        class="d-inline-block form-delete-{{ $user->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $user->id }}"
                            data-href="{{ route('user.destroy', $user->id) }}">
                            <i class="fas fa-trash-alt"></i> {{ __('Delete') }}
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="row align-items-center" style="margin-top: 15px;">
    <div class="col-sm-6">
        {{ __('Showing') }} {{ $users->firstItem() }} {{ __('to') }} {{ $users->lastItem() }}
        {{ __('of') }} {{ $users->total() }} {{ __('entries') }}
    </div>
    <nav aria-label="Page navigation example" class="d-flex justify-content-end" style="margin-top: -25px;">
        <ul class="pagination">

            {{-- Previous Page Link --}}
            <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $users->previousPageUrl() ?? '#' }}" tabindex="-1">
                    {{ __('Previous') }}
                </a>
            </li>

            {{-- Pagination Elements (Show up to 3 pages for simplicity) --}}
            @php
                $start = max(1, $users->currentPage() - 1);
                $end = min($users->lastPage(), $users->currentPage() + 1);
            @endphp

            @for ($page = $start; $page <= $end; $page++)
                <li class="page-item {{ $page == $users->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $users->url($page) }}">{{ $page }}</a>
                </li>
            @endfor

            {{-- Next Page Link --}}
            <li class="page-item {{ !$users->hasMorePages() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $users->nextPageUrl() ?? '#' }}">
                    {{ __('Next') }}
                </a>
            </li>

        </ul>
    </nav>
</div>
