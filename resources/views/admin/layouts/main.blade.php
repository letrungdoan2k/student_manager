<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    @include('admin.layouts.style')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset('adminlte') }}/dist/img/AdminLTELogo.png" alt="AdminLTELogo"
             height="60" width="60">
    </div>

    <!-- Navbar -->
@include('admin.layouts.header')
<!-- /.navbar -->

    <!-- Main Sidebar Container -->
@include('admin.layouts.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                @yield('content')

                <div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                     aria-labelledby="myLargeModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form class="profile-form-update">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Update Profile</h5>
                                    <button type="button" class="close" onclick="hideModal()">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-row">
                                        <input type="hidden" name="id">
                                        <div class="form-group col-md-6">
                                            <label for="inputNam4">Họ và Tên</label>
                                            <input type="text" name="name"
                                                   class="form-control"
                                                   data-rule="required" placeholder="Name">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputBirthday4">Birthday</label>
                                            <input class="form-control" name="birthday"
                                                   type="date"
                                                   data-rule="required|date" id="example-date-input">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputBirthday4">Gender</label>
                                            <select name="gender" id="inputState" data-rule="required"
                                                    class="form-control">
                                                    <option value="0">Male</option>
                                                    <option value="1">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputemail2">Email</label>
                                            <input type="email" name="email"
                                                   class="form-control"
                                                   data-rule="required|email" placeholder="example@gmal.com">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPhone2">Phone Number</label>
                                            <input type="number" name="phone"
                                                   class="form-control"
                                                   data-rule="required|checkPhone" placeholder="phone number">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputAddress">Address</label>
                                            <input type="text" name="address"
                                                   class="form-control"
                                                   data-rule="required">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="avatar">Avatar</label>
                                            <input type="file" name="avatar" class="form-control">
                                            <small id="fileHelp" class="form-text text-muted">File phải có định dạng png
                                                hoặc
                                                jpg.</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" onclick="hideModal()">Close</button>
                                    <button type="submit" class="btn btn-primary btn-submit">Save
                                        changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.1.0
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
@include('admin.layouts.script')
</body>
</html>
