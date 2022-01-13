@extends('admin.layouts.main')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">{{!empty($student->id) ? 'Edit' : 'Add'}}</h1>
                </div>
                <div class="card-body">
                    @if(!empty($student->id))
                        {!! Form::model($student, ['method' => 'PUT', 'route' => ['students.update', $student->id]]) !!}
                    @else
                        {!! Form::model($student, ['method' => 'POST', 'route' => ['students.store']]) !!}
                    @endif
                    {!! Form::hidden('id', $student->id) !!}
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                {!!  Form::label('name', 'Name:') !!}
                                {!!  Form::text('name', $student->name , ['class' => 'form-control']) !!}
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <br>
                                {!!  Form::label('faculty_id', 'Faculty:') !!}
                                <br>
                                {!! Form::select('faculty_id', $faculties, $student->faculty_id, ['class' => 'form-control']) !!}
                                @error('faculty_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <br>
                                {!!  Form::label('birthday', 'Birthday:') !!}
                                {!!  Form::date('birthday', \Carbon\Carbon::now() , ['class' => 'form-control']) !!}
                                @error('birthday')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <br>
                                {!!  Form::label('image', 'Image:') !!}
                                {!!  Form::file('image', ['class' => 'form-control']) !!}
                                @if(!empty($array['id']))
                                    <img src="{{asset('storage/' . $student->image)}}" width="80">
                                @endif
                                @error('image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                {!!  Form::label('email', 'Email:') !!}
                                {!!  Form::email('email', !empty($array['id']) ? $student->email : '' , ['class' => 'form-control']) !!}
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <br>
                                {!!  Form::label('phone', 'Phone:') !!}
                                {!!  Form::number('phone', !empty($array['id']) ? $student->phone : '' , ['class' => 'form-control']) !!}
                                @error('phone')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <br>
                                {!!  Form::label('address', 'Address:') !!}
                                {!!  Form::text('address', !empty($array['id']) ? $student->address : '' , ['class' => 'form-control']) !!}
                                @error('address')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <br>
                                {!!  Form::label('gender', 'Gender:') !!}
                                <br>
                                {!! Form::select('gender', $genders, $student->gender, ['class' => 'form-control']) !!}
                                @error('gender')
                                <span class="text-danger">{{$message}}</span>
                                @enderror

                            </div>
                        </div>
                        <br>
                        <div class="col-12 d-flex justify-content-end">
                            <br>
                            <a href="{{route('students.index')}}" class="btn btn-danger">Hủy</a>
                            &nbsp;{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
@endsection
