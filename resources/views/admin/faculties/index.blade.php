@extends('admin.layouts.main')
@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
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
                        @foreach ($faculties as $faculty)
                            <tr>
                                <td>{{($faculties->currentPage() - 1)*$faculties->perPage() + $loop->iteration}}</td>
                                <td>{{$faculty->name}}</td>
                                <td class="d-flex">
                                    <a href="{{route('faculties.show', ['faculty' => $faculty->id])}}"
                                       class="btn btn-info"><i class="bi bi-info-lg"></i></a>
                                    <a href="{{route('faculties.edit', ['faculty' => $faculty->id])}}"
                                       class="btn btn-info ml-1"><i class="bi bi-pencil-square"></i></a>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['faculties.destroy', 'faculty' => $faculty->id]]) !!}
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
        {{ $faculties->links() }}
    </div>
@endsection
