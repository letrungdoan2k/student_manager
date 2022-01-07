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
                            <a href="{{route('faculties.create')}}" class="btn btn-primary">Add new</a>
                        </th>
                        </thead>
                        <tbody>
                        @foreach ($faculty as $key => $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
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
{{--    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"--}}
{{--         aria-labelledby="exampleModalLabel"--}}
{{--         aria-hidden="true">--}}
{{--        <div class="modal-dialog" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title" id="exampleModalLabel">Warning!!!</h5>--}}
{{--                    <button type="button" class="close" data-dismiss="modal"--}}
{{--                            aria-label="Close">--}}
{{--                        <span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    Are you sure you want to remove--}}
{{--                </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <button type="button" class="btn btn-secondary"--}}
{{--                            data-dismiss="modal">Close--}}
{{--                    </button>--}}
{{--                    <button type="button" class="btn btn-danger ml-2" data-toggle="modal"--}}
{{--                            data-target="#exampleModal">--}}
{{--                        Remove--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
