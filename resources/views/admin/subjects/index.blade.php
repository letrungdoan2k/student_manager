@extends('admin.layouts.main')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-stripped">
                        <thead>
                        <th>STT</th>
                        <th>Name</th>
                        <th>
                            <a href="{{route('subjects.create')}}" class="btn btn-primary">Add</a>
                        </th>
                        </thead>
                        <tbody>
                        @foreach ($subjects as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->name}}</td>
                                <td class="d-flex">
                                    <a href="{{route('subjects.edit', ['subject' => $item->id])}}"
                                       class="btn btn-info">Edit</a>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['subjects.destroy', 'subject' => $item->id]]) !!}
                                    {!! Form::submit('Remove', ['class' => 'btn btn-danger ml-2', 'data-dismiss' => 'modal']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
