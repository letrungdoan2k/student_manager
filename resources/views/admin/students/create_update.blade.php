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
                        {!! Form::model($student, ['method' => 'PUT', 'route' => ['students.update', $student->id], 'enctype' => 'multipart/form-data']) !!}
                    @else
                        {!! Form::model($student, ['method' => 'POST', 'route' => ['students.store'], 'enctype' => 'multipart/form-data']) !!}
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
                                {!!  Form::date('birthday', !empty($student->id) ? $student->date : \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
                                @error('birthday')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <br>
                                {!!  Form::label('image', 'Image:') !!}
                                {!!  Form::file('image', ['class' => 'form-control']) !!}
                                @if(!empty($student->id))
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
                                {!!  Form::email('email', $student->email, ['class' => 'form-control']) !!}
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <br>
                                {!!  Form::label('phone', 'Phone:') !!}
                                {!!  Form::number('phone', $student->phone, ['class' => 'form-control']) !!}
                                @error('phone')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <br>
                                {!!  Form::label('address', 'Address:') !!}
                                {!!  Form::text('address', $student->address, ['class' => 'form-control']) !!}
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
                        <div class="col-12 d-flex justify-content-start mt-5">
                            <br>
                            <h1>Add Point</h1>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-4">
                                    {!!  Form::label('subject_id', 'Subject:') !!}
                                </div>
                                <div class="col-4">
                                    {!!  Form::label('point', 'Point:') !!}
                                </div>
                                <div class="col-4">
                                    <i class="bi bi-plus-square-fill btn btn-primary"></i>
                                </div>
                            </div>
                            <br>
{{--                            @for($i = 1; $i <= 3; $i++)--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-4">--}}
{{--                                        {!! Form::select('subject_id[]', $subjects, null, ['class' => 'form-control']) !!}--}}
{{--                                    </div>--}}
{{--                                    <div class="col-4">--}}
{{--                                        {!!  Form::text('point[]', $student->point, ['class' => 'form-control']) !!}--}}
{{--                                    </div>--}}
{{--                                    <div class="col-4">--}}
{{--                                        <button type="submit" class="bi bi-trash btn btn-danger"></button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <br>--}}
{{--                            @endfor--}}
                        </div>
                        <br>
                        <div class="col-12 d-flex justify-content-end mt-5">
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
