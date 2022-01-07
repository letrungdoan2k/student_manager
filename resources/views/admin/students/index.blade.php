@extends('admin.layouts.main')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-stripped">
                        <thead>
                        <th>STT</th>
                        <th>Name</th>
                        <th>Birthday</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Image</th>
                        <th>Faculty</th>
                        <th>
                            <a href="{{route('students.create')}}" class="btn btn-primary">Add</a>
                        </th>
                        </thead>
                        <tbody>
                        @foreach ($students as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->birthday}}</td>
                                <td>{{$item->address}}</td>
                                <td>{{$item->phone}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->gender}}</td>
                                <td>
                                    <img src="{{asset('images' . $item->image)}}" width="80">
                                </td>
                                <td>{{$item->faculty}}</td>
                                <td class="d-flex">
                                    <a href="{{route('students.edit', ['student' => $item->id])}}"
                                       class="btn btn-info">Edit</a>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['students.destroy', 'student' => $item->id]]) !!}
                                    {!! Form::submit('Remove', ['class' => 'btn btn-danger ml-2']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
