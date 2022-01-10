@extends('admin.layouts.main')
@section('content')
    <div>
        <h1>{{$faculties->name}}</h1>
        <a href="{{route('faculties.index')}}" class="btn btn-danger">Thoát</a>
    </div>
@endsection
