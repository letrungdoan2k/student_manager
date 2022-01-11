@extends('admin.layouts.main')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ !empty($array['id']) ? 'Edit' : 'Add' }}</h3>
                </div>
                <div class="card-body">
                    {!! Form::model($subjects, ['method' => $method, 'route' => [$array['route'], $array['id']]]) !!}
                    {!! Form::hidden('id', !empty($array['id']) ? $subjects->id : '') !!}
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                {!!  Form::label('name', 'subject name') !!}
                                {!!  Form::text('name', !empty($array['id']) ? $subjects->name : '' , ['class' => 'form-control']) !!}
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <br>
                            <a href="{{route('subjects.index')}}" class="btn btn-danger">Hủy</a>
                            &nbsp;{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
@endsection
