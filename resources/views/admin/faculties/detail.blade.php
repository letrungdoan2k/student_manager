@extends('admin.layouts.main')
@section('link')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('faculties.index')}}">Faculties</a></li>
        <li class="breadcrumb-item active">Detail/li>
    </ol>
@endsection
@section('content')
    <div>
        <h1>{{$faculties->name}}</h1>
        <a href="{{route('faculties.index')}}" class="btn btn-danger">Exit</a>
    </div>
@endsection
