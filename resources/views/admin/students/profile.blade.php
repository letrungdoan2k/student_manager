@extends('admin.layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="topbar border-bottom">
            <ul class="nav">
                <li class="nav-link">
                    <h3>Profile</h3>
                </li>
            </ul>
        </div>
        <div class="content mt-3 d-flex">
            <div class="col-md-4 bg-light p-2">
                @if(!empty($student->image))
                    <img src="{{asset('storage/' . $student->image)}}" class="img-profile col-md-5 d-inline-block"/>
                @else
                    <img src="{{ asset('adminlte') }}/dist/img/avata.jpg" class="img-profile col-md-5 d-inline-block"/>
                @endif
                <div class="d-inline-block">
                    <h5>{{ $student->name }}</h5>
                    <p>Student</p>
                </div>
                    <input type="hidden" id="profileId" value="{{ $student->id }}">
                <div class="p-2 mt-3">
                    <p><b>email: </b><span id="profileEmail">{{ $student->email }}</span></p>
                    <p><b>Phone: </b><span id="profilePhone">{{ $student->phone }}</span></p>
                    <p>
                        <b>Status: </b>
                        @if($student->status == 0)
                            <span class="text-info">Học đi</span>
                        @elseif($student->status == 1)
                            <span class="text-success">Học xong</span>
                        @endif
                    </p>
                </div>
                <!-- Button trigger modal -->
                <div class="col-auto mt-3">
                    <button class="btn btn-primary" onclick="profileStudent({{$student->id}})">
                        Profile-update
                    </button>
                    <button class="btn btn-warning" onclick="registerSubject({{$student->id}})">
                        Register subject
                    </button>
                </div>
            </div>
            <div class="col-md-8 bg-light p-2">
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
                                                class="col-xl-3 col-lg-3 col-form-label">Name</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input type="text" name="name"
                                                       value="{{ $student->name }}" disabled
                                                       class="form-control"></div>
                                        </div>
                                        <div class="form-group row">
                                            <label
                                                class="col-xl-3 col-lg-3 col-form-label">Gender</label>
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
                                                class="col-xl-3 col-lg-3 col-form-label">Birthday</label>
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
                                    </div>
                                    <div class="row">
                                        <label class="col-xl-3"></label>
                                        <div class="col-lg-9 col-xl-6">
                                            <h3 class="kt-section__title kt-section__title-sm">Average-score
                                                : <span>{{ $student->average_score }}</span></h3>
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
