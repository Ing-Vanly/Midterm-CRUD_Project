<!-- Navigation Bar with Logout Dropdown -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('dashboard') }}" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('dashboard') }}" class="nav-link">Contact</a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li>
            <div class="margin">
                <div class="btn-group">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                        Super Admin
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                        <a href="{{ route('settings.index') }}" class="dropdown-item">
                            <i class="fas fa-sliders-h mr-2"></i> {{ __('System Settings') }}
                        </a>
                        <a id="header-logout" href="#" onclick="event.preventDefault()" data-toggle="modal"
                            data-target="#modal-logout" class="dropdown-item">
                            <i class="fa fa-power-off mr-2"></i> {{ __('Logout') }}
                        </a>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</nav>

<!-- Hidden Logout Form -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<!-- Logout Confirmation Modal -->
<div class="modal fade" id="modal-logout" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">{{ __('Confirm Logout') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ __('Are you sure you want to logout?') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">{{ __('Cancel') }}</button>
                <a id="confirm-logout" href="#" class="btn btn-danger">{{ __('Logout') }}</a>
            </div>
        </div>
    </div>
</div>

@stack('js')
<script>
    // Show the logout confirmation modal
    function showLogoutModal() {
        $('#modal-logout').modal('show');
    }

    // Handle the logout confirmation
    document.getElementById('confirm-logout').addEventListener('click', function(e) {
        e.preventDefault();
        // Submit the logout form - this will trigger a POST request to the logout route
        document.getElementById('logout-form').submit();
    });
</script>
