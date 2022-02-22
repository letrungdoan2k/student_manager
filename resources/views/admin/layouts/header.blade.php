<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">{{ __('messages.Home') }}</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="langDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bi bi-translate"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="langDropdown">
                <a class="dropdown-item" href="{{route('language', ['language' => 'vi'])}}">VI</a>
                <a class="dropdown-item" href="{{route('language', ['language' => 'en'])}}">EN</a>
            </div>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('logout')}}" class="nav-link">{{ __('messages.logout') }}</a>
        </li>
    </ul>
</nav>
