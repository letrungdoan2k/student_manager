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
                <div class="p-2 mt-3">
                    <p><b>email: </b><span>{{ $student->email }}</span></p>
                    <p><b>Phone: </b><span>{{ $student->phone }}</span></p>
                    <p><b>Status: </b>
                        @if($student->status == 0)
                            <span class="text-info">Học đi</span>
                        @elseif($student->status == 1)
                            <span class="text-success">Học xong</span>
                        @endif
                    </p>
                </div>
                <!-- Button trigger modal -->
                <div class="col-auto mt-3">
                    <a href="#" class="btn btn-danger">
                        Reset Password
                    </a>
                    <button class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">
                        Profile-update
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
                                                <input type="text"
                                                       value="{{ $student->name }}" disabled
                                                       class="form-control"></div>
                                        </div>
                                        <div class="form-group row">
                                            <label
                                                class="col-xl-3 col-lg-3 col-form-label">Gender</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input type="text"
                                                       value="{{ $student->gender == 0 ? 'Male' : 'Female' }}"
                                                       disabled class="form-control"></div>
                                        </div>
                                        <div class="form-group row">
                                            <label
                                                class="col-xl-3 col-lg-3 col-form-label">Birthday</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input type="text"
                                                       value="{{ $student->birthday }}"
                                                       disabled class="form-control"></div>
                                        </div>
                                        <div class="form-group row">
                                            <label
                                                class="col-xl-3 col-lg-3 col-form-label">Address</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input type="text" value="{{ $student->address }}" disabled
                                                       class="form-control"></div>
                                        </div>
                                        <div class="form-group row">
                                            <label
                                                class="col-xl-3 col-lg-3 col-form-label">Faculty</label>
                                            <div class="col-lg-9 col-xl-6">
                                                @if(!empty($student->faculty_id))
                                                    <input type="text" value="{{ $student->faculty->name }}" disabled
                                                           class="form-control"></div>
                                            @else
                                                <input type="text" disabled class="form-control"></div>
                                        @endif
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
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Update Profile</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputNam4">Họ và Tên</label>
                                <input type="text" name="name" value="{{$student->name}}" class="form-control"
                                       data-rule="required" placeholder="Name">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputBirthday4">Birthday</label>
                                <input class="form-control" name="birthday" value="{{$student->birthday}}" type="date"
                                       data-rule="required|date" id="example-date-input">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputBirthday4">Gender</label>
                                <select name="gender" id="inputState" data-rule="required" class="form-control">
                                    @if($student->gender == 0)
                                        <option value="0" selected>Male</option>
                                        <option value="1">Female</option>
                                    @else
                                        <option value="0">Male</option>
                                        <option value="1" selected>Female</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputemail2">Email</label>
                                <input type="email" name="email" value="{{$student->email}}" class="form-control"
                                       data-rule="required|email" placeholder="example@gmal.com">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPhone2">Phone Number</label>
                                <input type="number" name="phone" value="{{$student->phone}}" class="form-control"
                                       data-rule="required|checkPhone" placeholder="0123456789">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputAddress">Address</label>
                                <input type="text" name="address" value="{{$student->address}}" class="form-control"
                                       data-rule="required">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputFile">Avatar</label>
                                <input type="hidden" name="avatarDefault" value="{{ $student->avatar }}">
                                <input type="file" name="avatar" class="form-control">
                                <small id="fileHelp" class="form-text text-muted">File phải có định dạng png hoặc
                                    jpg.</small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-submit" data-dismiss="modal">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
