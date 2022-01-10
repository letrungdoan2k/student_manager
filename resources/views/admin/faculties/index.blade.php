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
                            <a href="{{route('faculties.create')}}" class="btn btn-primary">Add</a>
                        </th>
                        </thead>
                        <tbody>
                        @foreach ($faculties as $item)
                            <tr>
                                <td>{{($faculties->currentPage() - 1)*$faculties->perPage() + $loop->iteration}}</td>
                                <td>{{$item->name}}</td>
                                <td class="d-flex">
                                    <a href="{{route('faculties.edit', ['faculty' => $item->id])}}"
                                       class="btn btn-info">Edit</a>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['faculties.destroy', 'faculty' => $item->id]]) !!}
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
    <br>
    <div class="d-flex">
        {{ $faculties->onEachSide(1)->links() }}
    </div>
@endsection
