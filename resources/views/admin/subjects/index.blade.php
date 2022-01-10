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
                                    <a href="{{route('subjects.show', ['subject' => $item->id])}}"
                                       class="btn btn-info"><i class="bi bi-info-lg"></i></a>
                                    <a href="{{route('subjects.edit', ['subject' => $item->id])}}"
                                       class="btn btn-info ml-1"><i class="bi bi-pencil-square"></i></a>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['subjects.destroy', 'subject' => $item->id]]) !!}
                                    <button type="submit" class="bi bi-trash btn btn-danger ml-1"></button>
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
    <br>
    <div class="d-flex">
        {{ $subjects->links() }}
    </div>
@endsection
