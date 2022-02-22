@extends('admin.layouts.main')
@section('link')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('students.index')}}">{{__('messages.Student')}}</a></li>
        <li class="breadcrumb-item active">{{__('messages.Student-list')}}</li>
    </ol>
@endsection
@section('content')
    {!! Form::open(['method' => 'GET', 'route' => 'students.index']) !!}
    <div class="form-group d-flex">
        {!!  Form::label('from-age', __('messages.Age').':') !!}
        <div>
            {!!  Form::number('from-age', !empty($request['from-age']) ? $request['from-age'] : null, ['class' => 'ml-4', 'placeholder' => 'Min']) !!}
            @error('from-age')
            <br>
            <span class="text-danger ml-3">{{$message}}</span>
            @enderror
        </div>
        {{__('messages.To')}} :
        <div>
            {!!  Form::number('to-age', !empty($request['to-age']) ? $request['to-age'] : null, ['class' => 'ml-3', 'placeholder' => 'Max']) !!}
            @error('to-age')
            <br>
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
    <div class="form-group d-flex">
        {!!  Form::label('from-point', __('messages.Point').': ') !!}
        <div>
            {!!  Form::number('from-point', !empty($request['from-point']) ? $request['from-point'] : null, ['class' => 'ml-3', 'placeholder' => 'Min']) !!}
            @error('from-point')
            <br>
            <span class="text-danger ml-3">{{$message}}</span>
            @enderror
        </div>
        {{__('messages.To')}} :
        <div>
            {!!  Form::number('to-point', !empty($request['to-point']) ? $request['to-point'] : null, ['class' => 'ml-3', 'placeholder' => 'Max']) !!}
            @error('to-point')
            <br>
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        {!!  Form::label('phone[]', __('messages.Phone').': ') !!}
        {!!  Form::checkbox('phone[]', 'viettel', !empty($request['phone']) ? (in_array('viettel', $request['phone']) ? true : false) : false, ['class' => 'name ml-4']) !!}
        : Viettel
        {!!  Form::checkbox('phone[]', 'mobi', !empty($request['phone']) ? (in_array('mobi', $request['phone']) ? true : false) : false, ['class' => 'name ml-4']) !!}
        : Mobi
        {!!  Form::checkbox('phone[]', 'vina', !empty($request['phone']) ? (in_array('vina', $request['phone']) ? true : false) : false, ['class' => 'name ml-4']) !!}
        : Vina
    </div>
    <div class="form-group col-3 d-flex">
        {!!  Form::label('perPage', __('messages.Per-page').': ') !!}
        <div>
            {!! Form::select('perPage', $perPage, $studentAll->perPage(), ['class' => 'form-control']) !!}
        </div>
    </div>
    <div>
        {!! Form::submit(__('messages.Submit'), ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
    <br>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                    type="button" role="tab" aria-controls="nav-home" aria-selected="true">{{__('messages.All')}}
            </button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false">{{__('messages.Unfinished')}}
            </button>
            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact"
                    type="button" role="tab" aria-controls="nav-contact" aria-selected="false">{{__('messages.Done')}}
            </button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="row">
                <table class="table table-striped col-12">
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
                        @if(Auth::user()->hasanyrole('staff|admin'))
                            <a href="{{route('students.create')}}" class="btn btn-primary">{{__('messages.Add')}}</a>
                        @else
                            <a href="{{route('students.create')}}" class="btn btn-primary disabled">{{__('messages.Add')}}</a>
                        @endif
                        @if(Auth::user()->hasrole('admin'))
                            <a href="{{route('mail.index')}}" class="btn btn-primary">
                                <i class="fas fa-mail-bulk"></i>
                            </a>
                        @else
                            <a href="{{route('mail.index')}}" class="btn btn-primary disabled">
                                <i class="fas fa-mail-bulk"></i>
                            </a>
                        @endif
                    </th>
                    </thead>
                    <tbody>
                    @foreach ($studentAll as $student)
                        <tr>
                            <td>{{($studentAll->currentPage() - 1) * $studentAll->perPage() + $loop->iteration}}</td>
                            <td id="name{{$student->id}}">{{$student->name}}</td>
                            <td>{{$student->birthday}}</td>
                            <td>{{$student->address}}</td>
                            <td>{{$student->phone}}</td>
                            <td>{{$student->email}}</td>
                            <td>{{$student->gender_text}}</td>
                            <td>
                                @if(!$student->image)
                                    null
                                @else
                                    <img src="{{asset('storage/' . $student->image)}}" width="80">
                                @endif
                            </td>
                            @if(!empty($student->faculty_id))
                                <td>{{$student->faculty->name}}</td>
                            @else
                                <td></td>
                            @endif
                            <td class="d-flex">
                                <a href="{{route('show.student', ['slug' => $student->slug])}}"
                                   class="btn btn-success">
                                    <i class="bi bi-info-lg"></i>
                                </a>
                                @if(Auth::user()->hasrole('member'))
                                    <a href="{{route('students.edit', ['student' => $student->id])}}"
                                       class="btn btn-warning ml-1 disabled">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                @else
                                    <a href="{{route('students.edit', ['student' => $student->id])}}"
                                       class="btn btn-warning ml-1">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                @endif
                                {!! Form::open(['method' => 'DELETE', 'route' => ['students.destroy', 'student' => $student->id], 'id' => 'deleteStudent' . $student->id]) !!}
                                @if(Auth::user()->id != $student->user_id && Auth::user()->hasrole('admin'))
                                    <button type="button" onclick="onDelete({{$student->id}},'student')"
                                            class="bi bi-trash btn btn-danger ml-1"></button>
                                @else
                                    <button type="button" onclick="onDelete({{$student->id}},'student')"
                                            class="bi bi-trash btn btn-danger ml-1" disabled></button>
                                @endif
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <a href=""></a>
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
                            <th>{{__('messages.Name')}}</th>
                            <th>{{__('messages.Birthday')}}</th>
                            <th>{{__('messages.Address')}}</th>
                            <th>{{__('messages.Phone')}}</th>
                            <th>{{__('messages.Email')}}</th>
                            <th>{{__('messages.Gender')}}</th>
                            <th>{{__('messages.Avatar')}}</th>
                            <th>{{__('messages.Faculty')}}</th>
                            <th>
                                @if(Auth::user()->hasanyrole('staff|admin'))
                                    <a href="{{route('students.create')}}" class="btn btn-primary">{{__('messages.Add')}}</a>
                                @else
                                    <a href="{{route('students.create')}}" class="btn btn-primary disabled">{{__('messages.Add')}}</a>
                                @endif
                                @if(Auth::user()->hasrole('admin'))
                                    <a href="{{route('mail.index')}}" class="btn btn-primary">
                                        <i class="fas fa-mail-bulk"></i>
                                    </a>
                                @else
                                    <a href="{{route('mail.index')}}" class="btn btn-primary disabled">
                                        <i class="fas fa-mail-bulk"></i>
                                    </a>
                                @endif
                            </th>
                            </thead>
                            <tbody>
                            @foreach ($studentUnfinised as $student)
                                <tr>
                                    <td>{{($studentUnfinised->currentPage() - 1) * $studentUnfinised->perPage() + $loop->iteration}}</td>
                                    <td id="name{{$student->id}}">{{$student->name}}</td>
                                    <td>{{$student->birthday}}</td>
                                    <td>{{$student->address}}</td>
                                    <td>{{$student->phone}}</td>
                                    <td>{{$student->email}}</td>
                                    <td>{{$student->gender_text}}</td>
                                    <td>
                                        @if(!$student->image)
                                            null
                                        @else
                                            <img src="{{asset('storage/' . $student->image)}}" width="80">
                                        @endif
                                    </td>
                                    @if(!empty($student->faculty_id))
                                        <td>{{$student->faculty->name}}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    <td class="d-flex">
                                        <a href="{{route('students.show', ['student' => $student->user_id])}}"
                                           class="btn btn-success">
                                            <i class="bi bi-info-lg"></i>
                                        </a>
                                        @if(Auth::user()->hasrole('member'))
                                            <a href="{{route('students.edit', ['student' => $student->id])}}"
                                               class="btn btn-warning ml-1 disabled">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        @else
                                            <a href="{{route('students.edit', ['student' => $student->id])}}"
                                               class="btn btn-warning ml-1">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        @endif
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['students.destroy', 'student' => $student->id], 'id' => 'deleteStudent' . $student->id]) !!}
                                        @if(Auth::user()->id != $student->user_id && Auth::user()->hasrole('admin'))
                                            <button type="button" onclick="onDelete({{$student->id}},'student')"
                                                    class="bi bi-trash btn btn-danger ml-1"></button>
                                        @else
                                            <button type="button" onclick="onDelete({{$student->id}},'student')"
                                                    class="bi bi-trash btn btn-danger ml-1" disabled></button>
                                        @endif
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
                            <th>{{__('messages.Name')}}</th>
                            <th>{{__('messages.Birthday')}}</th>
                            <th>{{__('messages.Address')}}</th>
                            <th>{{__('messages.Phone')}}</th>
                            <th>{{__('messages.Email')}}</th>
                            <th>{{__('messages.Gender')}}</th>
                            <th>{{__('messages.Avatar')}}</th>
                            <th>{{__('messages.Faculty')}}</th>
                            <th>
                                @if(Auth::user()->hasanyrole('staff|admin'))
                                    <a href="{{route('students.create')}}" class="btn btn-primary">{{__('messages.Add')}}</a>
                                @else
                                    <a href="{{route('students.create')}}" class="btn btn-primary disabled">{{__('messages.Add')}}</a>
                                @endif
                                @if(Auth::user()->hasrole('admin'))
                                    <a href="{{route('mail.index')}}" class="btn btn-primary">
                                        <i class="fas fa-mail-bulk"></i>
                                    </a>
                                @else
                                    <a href="{{route('mail.index')}}" class="btn btn-primary disabled">
                                        <i class="fas fa-mail-bulk"></i>
                                    </a>
                                @endif
                            </th>
                            </thead>
                            <tbody>
                            @foreach ($studentDone as $student)
                                <tr>
                                    <td>{{($studentDone->currentPage() - 1) * $studentDone->perPage() + $loop->iteration}}</td>
                                    <td id="name{{$student->id}}">{{$student->name}}</td>
                                    <td>{{$student->birthday}}</td>
                                    <td>{{$student->address}}</td>
                                    <td>{{$student->phone}}</td>
                                    <td>{{$student->email}}</td>
                                    <td>{{$student->gender_text}}</td>
                                    <td>
                                        @if(!$student->image)
                                            null
                                        @else
                                            <img src="{{asset('storage/' . $student->image)}}" width="80">
                                        @endif
                                    </td>
                                    @if(!empty($student->faculty_id))
                                        <td>{{$student->faculty->name}}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    <td class="d-flex">
                                        @if(Auth::user()->hasrole('member') && Auth::user()->id != $student->user_id)
                                            <a href="{{route('students.show', ['student' => $student->user_id])}}"
                                               class="btn btn-success disabled">
                                                <i class="bi bi-info-lg"></i>
                                            </a>
                                        @else
                                            <a href="{{route('students.show', ['student' => $student->user_id])}}"
                                               class="btn btn-success">
                                                <i class="bi bi-info-lg"></i>
                                            </a>
                                        @endif
                                        @if(Auth::user()->hasrole('member'))
                                            <a href="{{route('students.edit', ['student' => $student->id])}}"
                                               class="btn btn-warning ml-1 disabled">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        @else
                                            <a href="{{route('students.edit', ['student' => $student->id])}}"
                                               class="btn btn-warning ml-1">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        @endif
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['students.destroy', 'student' => $student->id], 'id' => 'deleteStudent' . $student->id]) !!}
                                        @if(Auth::user()->id != $student->user_id && Auth::user()->hasrole('admin'))
                                            <button type="button" onclick="onDelete({{$student->id}},'student')"
                                                    class="bi bi-trash btn btn-danger ml-1"></button>
                                        @else
                                            <button type="button" onclick="onDelete({{$student->id}},'student')"
                                                    class="bi bi-trash btn btn-danger ml-1" disabled></button>
                                        @endif
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
