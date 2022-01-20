@extends('admin.layouts.main')
@section('content')
    <div>
        <h1>{{$subject->name}}</h1>
        <a href="{{route('subjects.index')}}" class="btn btn-danger">Exit</a>
    </div>
@endsection
