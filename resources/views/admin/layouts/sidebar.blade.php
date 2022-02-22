{{-- @dump($loggedInUser) --}}
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">
        <img src="{{ asset('adminlte') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if(!empty(Auth::user()->student->image))
                    <img src="{{asset('storage/' . Auth::user()->student->image)}}" class="img-circle elevation-2"
                         alt="User Image" style="width: 38px; height: 38px">
                @else
                    <img src="{{ asset('adminlte') }}/dist/img/avata.jpg" class="img-circle elevation-2"
                         alt="User Image" style="width: 38px; height: 38px">
                @endif
            </div>
            <div class="info">
                <a href="{{route('students.show', ['student' => Auth::user()->id])}}"
                   class="d-block">{{Auth::user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item ">
                    {{-- <li class="nav-item menu-open"> --}}
                    <a href="{{route('students.index')}}" class="nav-link ">
                        <i class="bi bi-people-fill" style="font-size: 22px;"></i>
                        <p class="ml-2">
                            {{__('messages.Student') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    {{-- <li class="nav-item menu-open"> --}}
                    <a href="{{route('faculties.index')}}" class="nav-link ">
                        <i class="bi bi-journal-bookmark-fill" style="font-size: 22px;"></i>
                        <p class="ml-2">
                            {{__('messages.Faculty') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    {{-- <li class="nav-item menu-open"> --}}
                    <a href="{{route('subjects.index')}}" class="nav-link ">
                        <i class="bi bi-book-fill" style="font-size: 22px;"></i>
                        <p class="ml-2">
                            {{__('messages.Subject') }}
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
