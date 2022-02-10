@extends('admin.layouts.main')
@section('content')
    {!! Form::open(['method' => 'GET', 'route' => 'students.index']) !!}
    <div class="form-group d-flex">
        {!!  Form::label('from-age', 'Age: ') !!}
        <div>
            {!!  Form::number('from-age', !empty($request['from-age']) ? $request['from-age'] : null, ['class' => 'ml-4', 'placeholder' => 'Min']) !!}
            @error('from-age')
            <br>
            <span class="text-danger ml-3">{{$message}}</span>
            @enderror
        </div>
        To :
        <div>
            {!!  Form::number('to-age', !empty($request['to-age']) ? $request['to-age'] : null, ['class' => 'ml-3', 'placeholder' => 'Max']) !!}
            @error('to-age')
            <br>
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
    <div class="form-group d-flex">
        {!!  Form::label('from-point', 'Point: ') !!}
        <div>
            {!!  Form::number('from-point', !empty($request['from-point']) ? $request['from-point'] : null, ['class' => 'ml-3', 'placeholder' => 'Min']) !!}
            @error('from-point')
            <br>
            <span class="text-danger ml-3">{{$message}}</span>
            @enderror
        </div>
        To :
        <div>
            {!!  Form::number('to-point', !empty($request['to-point']) ? $request['to-point'] : null, ['class' => 'ml-3', 'placeholder' => 'Max']) !!}
            @error('to-point')
            <br>
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        {!!  Form::label('phone[]', 'Phone: ') !!}
        {!!  Form::checkbox('phone[]', 'viettel', !empty($request['phone']) ? (in_array('viettel', $request['phone']) ? true : false) : false, ['class' => 'name ml-4']) !!}
        : Viettel
        {!!  Form::checkbox('phone[]', 'mobi', !empty($request['phone']) ? (in_array('mobi', $request['phone']) ? true : false) : false, ['class' => 'name ml-4']) !!}
        : Mobi
        {!!  Form::checkbox('phone[]', 'vina', !empty($request['phone']) ? (in_array('vina', $request['phone']) ? true : false) : false, ['class' => 'name ml-4']) !!}
        : Vina
    </div>
    <div>
        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
    <br>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                    type="button" role="tab" aria-controls="nav-home" aria-selected="true">All
            </button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Unfinished
            </button>
            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact"
                    type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Done
            </button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
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
                            <a href="{{route('mail.index')}}" class="btn btn-primary">point < 5</a>
                        </th>
                        </thead>
                        <tbody>
                        @foreach ($studentAll as $student)
                            <tr>
                                <td>{{($studentAll->currentPage() - 1) * $studentAll->perPage() + $loop->iteration}}</td>
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
                        {{ $studentAll->links() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
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
                            <a href="{{route('mail.index')}}" class="btn btn-primary">point < 5</a>
                        </th>
                        </thead>
                        <tbody>
                        @foreach ($studentUnfinised as $student)
                            <tr>
                                <td>{{($studentUnfinised->currentPage() - 1) * $studentUnfinised->perPage() + $loop->iteration}}</td>
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
                        {{ $studentUnfinised->links() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
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
                            <a href="{{route('mail.index')}}" class="btn btn-primary">point < 5</a>
                        </th>
                        </thead>
                        <tbody>
                        @foreach ($studentDone as $student)
                            <tr>
                                <td>{{($studentDone->currentPage() - 1) * $studentDone->perPage() + $loop->iteration}}</td>
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
                        {{ $studentDone->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
