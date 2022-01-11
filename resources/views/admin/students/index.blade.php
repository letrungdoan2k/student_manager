@extends('admin.layouts.main')
@section('content')
    <div class="row">
        <div class="col-12">
            <table class="table">
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
                        <td>{{$item->gender == 1 ? 'Nam' : 'Nữ'}}</td>
                        <td>
                            <img src="{{asset('storage/' . $item->image)}}" width="80">
                        </td>
                        <td>{{$item->faculties->name}}</td>
                        <td class="d-flex">
                            <a href="{{route('students.show', ['student' => $item->id])}}"
                               class="btn btn-info"><i class="bi bi-info-lg"></i></a>
                            <a href="{{route('students.edit', ['student' => $item->id])}}"
                               class="btn btn-info ml-1"><i class="bi bi-pencil-square"></i></a>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['students.destroy', 'student' => $item->id]]) !!}
                            <button type="submit" class="bi bi-trash btn btn-danger ml-1"></button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-12">
            {{ $students->links() }}
        </div>
    </div>
@endsection
