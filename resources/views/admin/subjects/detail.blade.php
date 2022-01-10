@extends('admin.layouts.main')
@section('content')
    <div>
        <h1>{{$subjects->name}}</h1>
        <a href="{{route('subjects.index')}}" class="btn btn-danger">Thoát</a>
    </div>
@endsection
