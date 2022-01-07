@extends('admin.layouts.main')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit</h3>
                </div>
                <div class="card-body">
                    {!! Form::open(['method' => 'PUT', 'route' => ['subjects.update', $subject->id]]) !!}
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                {!!  Form::label('name', 'Name subject') !!}
                                {!!  Form::text('name', $subject->name, ['class' => 'form-control']) !!}
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
