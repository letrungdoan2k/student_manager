@extends('admin.layouts.main')
@section('link')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('students.index')}}">{{__('messages.Student')}}</a></li>
        <li class="breadcrumb-item active">{{__('messages.Send-mail')}}</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                <th>STT</th>
                <th>{{__('messages.Name')}}</th>
                <th>{{__('messages.Birthday')}}</th>
                <th>{{__('messages.Address')}}</th>
                <th>{{__('messages.Phone')}}</th>
                <th>{{__('messages.Email')}}</th>
                <th>{{__('messages.Gender')}}</th>
                <th>{{__('messages.Avatar')}}</th>
                <th>{{__('messages.Faculty')}}</th>
                <th>
                    <a href="{{route('mail.store')}}" class="btn btn-primary">{{__('messages.Send-mail')}}</a>
                </th>
                </thead>
                <tbody>
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
                        @if(!empty($student->faculty_id))
                            <td>{{$student->faculty->name}}</td>
                        @else
                            <td></td>
                        @endif
                        <td class="d-flex">
                            <a href="{{route('students.show', ['student' => $student->user_id])}}"
                               class="btn btn-info"><i class="bi bi-info-lg"></i></a>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['students.destroy', 'student' => $student->id]]) !!}
                            <button type="button" class="bi bi-trash btn btn-danger ml-1" onclick="onDelete({{$student->id}})"></button>
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
