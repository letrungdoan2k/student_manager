@extends('admin.layouts.main')
@section('content')
    {!! Form::open(['method' => 'POST', 'route' => 'mail.store']) !!}
    <div class="form-group">
        {!!  Form::label('action', 'Choose: ') !!}
        {!!  Form::radio('action', 'all', null, ['class' => 'ml-4']) !!}
        : All
        {!!  Form::radio('action', 'score', null, ['class' => 'ml-4']) !!}
        : Average_score < 5
    </div>
    <div class="row">
        <div class="form-group">
            {!!  Form::label('title', 'Title: ') !!}
            {!!  Form::text('title', null, ['class' => 'form-control ml-4', 'placeholder' => 'Title']) !!}
        </div>
    </div>
    <div class="row">
        <div class="form-group">
            {!!  Form::label('content', 'Content: ') !!}
            <br>
            {!!  Form::textarea('content', null, ['class' => 'form-control ml-3', 'placeholder' => 'Content']) !!}
        </div>
    </div>
    <div>
        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
@endsection
