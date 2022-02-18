@extends('admin.layouts.main')
@section('link')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('subjects.index')}}">Subjects</a></li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>
@endsection
@section('content')
    <div>
        <h1>{{$subject->name}}</h1>
        <a href="{{route('subjects.index')}}" class="btn btn-danger">Exit</a>
    </div>
@endsection
