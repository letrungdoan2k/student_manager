@extends('admin.layouts.main')
@section('link')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('faculties.index')}}">Faculties</a></li>
        <li class="breadcrumb-item active">List faculity</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body m-auto w-75">
                    <table class="table table-stripped text-center">
                        <thead>
                        <th>STT</th>
                        <th>Name</th>
                        <th>
                            <button type="button" class="btn btn-primary" onclick="onClickFaculty(0, 'name', 'add')">Add</button>
                        </th>
                        </thead>
                        <tbody id="facultyTbody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection
