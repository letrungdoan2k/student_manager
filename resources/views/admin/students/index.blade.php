@extends('admin.layouts.main')
@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <table class="table table-striped">
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
{{--                @dd($students->links())--}}
                @foreach ($students as $student)
                    <tr>
                        <td>{{($students->currentPage() - 1) * $students->perPage() + $loop->iteration}}</td>
                        <td>{{$student->name}}</td>
                        <td>{{$student->birthday}}</td>
                        <td>{{$student->address}}</td>
                        <td>{{$student->phone}}</td>
                        <td>{{$student->email}}</td>
                        <td>{{$student->gender_text}}</td>
                        <td>
                            <img src="{{asset('storage/' . $student->image)}}" width="80">
                        </td>
                        <td>{{$student->faculty->name}}</td>
                        <td class="d-flex">
                            <a href="{{route('students.show', ['student' => $student->id])}}"
                               class="btn btn-info"><i class="bi bi-info-lg"></i></a>
                            <a href="{{route('students.edit', ['student' => $student->id])}}"
                               class="btn btn-info ml-1"><i class="bi bi-pencil-square"></i></a>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['students.destroy', 'student' => $student->id]]) !!}
                            <button type="submit" class="bi bi-trash btn btn-danger ml-1"></button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-12 justify-content-center">
            <div>
                {{ $students->links() }}
            </div>
        </div>
    </div>
@endsection
