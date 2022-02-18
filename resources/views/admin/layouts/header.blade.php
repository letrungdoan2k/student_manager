<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <select class="form-select border border-white" aria-label="Default select example">
            <option selected>EN</option>
            <option value="1">VI</option>
        </select>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('logout')}}" class="nav-link">Logout</a>
        </li>
    </ul>
</nav>
