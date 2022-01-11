@extends('admin.layouts.main')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">{{!empty($array['id']) ? 'Edit' : 'Add'}}</h1>
                </div>
{{--                @dd($errors)--}}
                <div class="card-body">
                    {!! Form::model($students, ['method' => $method, 'route' => [$array['route'], $array['id']], 'enctype' => 'multipart/form-data']) !!}
                    {!! Form::hidden('id', !empty($array['id']) ? $students->id : '') !!}
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                {!!  Form::label('name', 'Name:') !!}
                                {!!  Form::text('name', !empty($array['id']) ? $students->name : '' , ['class' => 'form-control']) !!}
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <br>
                                {!!  Form::label('faculty_id', 'Faculty:') !!}
                                <br>
                                {!! Form::select('faculty_id', $faculties, '', ['class' => 'form-control']) !!}
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
                                    <img src="{{asset('storage/' . $students->image)}}" width="80">
                                @endif
                                @error('image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                {!!  Form::label('email', 'Email:') !!}
                                {!!  Form::email('email', !empty($array['id']) ? $students->email : '' , ['class' => 'form-control']) !!}
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <br>
                                {!!  Form::label('phone', 'Phone:') !!}
                                {!!  Form::number('phone', !empty($array['id']) ? $students->phone : '' , ['class' => 'form-control']) !!}
                                @error('phone')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <br>
                                {!!  Form::label('address', 'Address:') !!}
                                {!!  Form::text('address', !empty($array['id']) ? $students->address : '' , ['class' => 'form-control']) !!}
                                @error('address')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <br>
                                {!!  Form::label('gender', 'Gender:') !!}
                                <br>
                                {!! Form::select('gender', $genders, '', ['class' => 'form-control']) !!}
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
