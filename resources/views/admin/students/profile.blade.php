@extends('admin.layouts.main')
@section('link')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('students.index')}}">{{__('messages.Student')}}</a></li>
        <li class="breadcrumb-item active">{{__('messages.Profile')}}</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="topbar border-bottom">
            <ul class="nav">
                <li class="nav-link">
                    <h3>{{__('messages.Profile')}}</h3>
                </li>
            </ul>
        </div>
        <div class="content mt-3 d-flex">
            <div class="col-md-6 bg-light p-2">
                @if(!empty($student->image))
                    <img src="{{asset('storage/' . $student->image)}}"
                         class="img-profile col-md-5 d-inline-block avataProfile"/>
                @else
                    <img src="{{ asset('adminlte') }}/dist/img/avata.jpg"
                         class="img-profile col-md-5 d-inline-block avataProfile"/>
                @endif
                <div class="d-inline-block">
                    <h5 id="nameH5">{{ $student->name }}</h5>
                </div>
                <input type="hidden" id="profileId" value="{{ $student->id }}">
                <div class="p-2 mt-3">
                    <p><b>{{__('messages.Email')}}: </b><span id="profileEmail">{{ $student->email }}</span></p>
                    <p><b>{{__('messages.Phone')}}: </b><span id="profilePhone">{{ $student->phone }}</span></p>
                    <p>
                        <b>{{__('messages.Status')}}: </b>
                        @if($student->status == 0)
                            <span class="text-info">Học đi</span>
                        @elseif($student->status == 1)
                            <span class="text-success">Học xong</span>
                        @endif
                    </p>
                </div>
                <!-- Button trigger modal -->
                @if(Auth::user()->hasanyrole('staff|admin') || Auth::user()->id == $student->user_id)
                    <div class="col-auto mt-3">
                        <button class="btn btn-primary" onclick="profileStudent({{$student->id}})">
                            {{__('messages.Profile-update')}}
                        </button>
                        @if(Auth::user()->id == $student->user_id)
                            <button class="btn btn-warning" onclick="registerSubject({{$student->id}})">
                                {{__('messages.Register-subject')}}
                            </button>
                        @endif
                        @if(Auth::user()->hasrole('admin'))
                            <button class="btn btn-success" onclick="permission({{$student->user_id}})">
                                {{__('messages.Permission')}}
                            </button>
                        @endif
                    </div>
                @endif
            </div>
            <div class="col-md-6 bg-light p-2">
                <div class="row">
                    <div class="col-xl-12">
                        <form class="kt-form kt-form--label-right">
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="row">
                                            <label class="col-xl-3"></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <h3 class="kt-section__title kt-section__title-sm">Profile</h3>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label
                                                class="col-xl-3 col-lg-3 col-form-label">{{__('messages.Name')}}</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input type="text" name="name"
                                                       value="{{ $student->name }}" disabled
                                                       class="form-control"></div>
                                        </div>
                                        <div class="form-group row">
                                            <label
                                                class="col-xl-3 col-lg-3 col-form-label">{{__('messages.Gender')}}</label>
                                            <div class="col-lg-9 col-xl-6">
                                                @if(isset($student->gender))
                                                    <input type="text" name="gender"
                                                           value="{{ $student->gender == 0 ? 'Male' : 'Female' }}"
                                                           disabled class="form-control">
                                                @else
                                                    <input type="text" name="gender"
                                                           disabled class="form-control">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label
                                                class="col-xl-3 col-lg-3 col-form-label">{{__('messages.Birthday')}}</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input type="text" name="birthday"
                                                       value="{{ $student->birthday }}"
                                                       disabled class="form-control"></div>
                                        </div>
                                        <div class="form-group row">
                                            <label
                                                class="col-xl-3 col-lg-3 col-form-label">Address</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input type="text" value="{{ $student->address }}" disabled
                                                       name="address" class="form-control"></div>
                                        </div>
                                        @if(!empty($student->faculty_id))
                                            <div class="form-group row">
                                                <label
                                                    class="col-xl-3 col-lg-3 col-form-label">{{__('messages.Faculty')}}</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input type="text" value="{{ $student->faculty->name }}" disabled
                                                           name="faculty" class="form-control"></div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <label class="col-xl-5"><h3>{{__('messages.Average-score')}}:</h3></label>
                                        <div class="col-lg-9 col-xl-3">
                                            <h3 class="kt-section__title kt-section__title-sm">
                                                <span>{{ number_format($student->average_score, 2) }}</span>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal -->
@endsection
