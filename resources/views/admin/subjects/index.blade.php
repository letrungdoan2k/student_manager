@extends('admin.layouts.main')
@section('link')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('subjects.index')}}">{{__('messages.Subject')}}</a></li>
        <li class="breadcrumb-item active">{{__('messages.Subject-list')}}</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body m-auto w-75">
                    <table class="table table-stripped text-center">
                        <thead>
                        <th>STT</th>
                        <th>{{__('messages.Subject-name')}}</th>
                        <th>
                            <a href="{{route('subjects.create')}}" class="btn btn-primary">{{__('messages.Add')}}</a>
                        </th>
                        </thead>
                        <tbody>
                        @foreach ($subjects as $subject)
                            <tr>
                                <td>{{($subjects->currentPage() - 1)*$subjects->perPage() + $loop->iteration}}</td>
                                <td>{{$subject->name}}</td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{route('subjects.show', ['subject' => $subject->id])}}"
                                       class="btn btn-info"><i class="bi bi-info-lg"></i></a>
                                    <a href="{{route('subjects.edit', ['subject' => $subject->id])}}"
                                       class="btn btn-info ml-1"><i class="bi bi-pencil-square"></i></a>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['subjects.destroy', 'subject' => $subject->id]]) !!}
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
