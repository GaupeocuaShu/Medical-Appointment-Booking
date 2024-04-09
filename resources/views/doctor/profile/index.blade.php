@extends('doctor.layout.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Profile</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Hi, {{ $user->first_name }}</h2>
            <p class="section-lead">
                Change information about yourself on this page.
            </p>

            <div class="row mt-sm-4">
                {{-- User Profile --}}
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card profile-widget">
                        <div class="card-header">
                            <h4>User Profile</h4>
                        </div>
                        <div class="card-body">
                            <div class="profile-widget-header">
                                <img alt="image" src="{{ asset($user->avatar) }}"
                                    class="rounded-circle profile-widget-picture">
                                <div class="profile-widget-items">
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">Email</div>
                                        <div class="profile-widget-item-value">{{ $user->email }}</div>
                                    </div>
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">Phone</div>
                                        <div class="profile-widget-item-value">{{ $user->phone }}</div>
                                    </div>
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">Address</div>
                                        <div class="profile-widget-item-value">{!! $user->address !!}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-widget-description">
                                <div class="profile-widget-name">{{ $fullName }} <div
                                        class="text-muted d-inline font-weight-normal">
                                        <div class="slash"></div>{{ Auth::user()->role }}
                                    </div>
                                </div>
                                {!! $user->description !!}
                            </div>
                        </div>

                    </div>
                </div>
                {{-- Doctor Profile --}}
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Doctor Profile</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center">

                                <div>
                                    <h4 class="font-weight-bold">
                                        {{ $doctor->academic_degree . ' ' . getFullName($doctor->user) }}</h4>
                                    <p><span class="font-weight-bold text-primary">Doctor</span> | <span
                                            class="font-weight-bold">{{ $doctor->experience_year }}</span> experiences year
                                    </p>
                                    <p><span>Speciality</span> &emsp;
                                        @foreach ($doctor->specializations as $s)
                                            <span class="text-primary font-weight-bold">
                                                {{ $s->name }} &emsp13;
                                            </span>
                                        @endforeach
                                    </p>
                                    <p class="">
                                        <span>Title</span> &emsp;
                                        <span class="text-primary font-weight-bold">
                                            {!! $doctor->title !!} &emsp13;
                                        </span>
                                    </p>
                                    <p>
                                        <span>Workplace</span> &emsp;
                                        <span class="text-primary font-weight-bold">
                                            {{ $doctor->workplace->name }} &emsp13;
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-4">Working Time</h5>
                                <hr>
                            </div>
                            <div>
                                <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                                    @foreach ($datesFrWTime as $key => $wTimes)
                                        @php
                                            $date = Carbon\Carbon::create($key);
                                        @endphp
                                        @if ($loop->index == 0)
                                            <li class="nav-item">
                                                <a class="nav-link active" id="{{ $key }}-tab" data-toggle="tab"
                                                    href="#{{ $key }}" role="tab"
                                                    aria-controls="{{ $key }}"
                                                    aria-selected="true">{{ $date->isoFormat('DD-MM') }}</a>
                                            </li>
                                        @else
                                            <li class="nav-item">
                                                <a class="nav-link " id="{{ $key }}-tab" data-toggle="tab"
                                                    href="#{{ $key }}" role="tab"
                                                    aria-controls="{{ $key }}"
                                                    aria-selected="false">{{ $date->isoFormat('DD-MM') }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                                <div class="tab-content mb-4" id="myTabContent">
                                    @foreach ($datesFrWTime as $key => $wTimes)
                                        @if ($loop->index == 0)
                                            <div class="tab-pane tab-pane-{{ $key }} fade show active "
                                                id="{{ $key }}" role="tabpanel"
                                                aria-labelledby="{{ $key }}-tab">
                                                @foreach ($wTimes as $wtime)
                                                    <form action="" style="display: inline">
                                                        <input type="hidden" name="date" value="{{ $key }}" />
                                                        <input type="hidden" name="doctor_id"
                                                            value="{{ $doctor->id }}" />
                                                        @php
                                                            $time = explode('/', $wtime)[0];
                                                            $isBusy = !empty(explode('/', $wtime)[1]);
                                                            $endTime = Carbon\Carbon::create($time);
                                                            $endTime->addMinutes(30);
                                                        @endphp
                                                        <input type="hidden" name="time" value="{{ $time }}" />
                                                        <input type="hidden" name="is_busy" value="{{ $isBusy }}" />
                                                        <button
                                                            class="working-time-button  mb-3 btn btn-lg {{ $isBusy ? 'btn-outline-warning' : 'btn-outline-primary' }}">{{ $time }}-{{ $endTime->isoFormat('HH:mm') }}</button>&emsp;
                                                    </form>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="tab-pane tab-pane-{{ $key }} fade"
                                                id="{{ $key }}" role="tabpanel"
                                                aria-labelledby="{{ $key }}-tab">
                                                @foreach ($wTimes as $wtime)
                                                    <form action="" style="display: inline">
                                                        <input type="hidden" name="date" value="{{ $key }}" />
                                                        <input type="hidden" name="doctor_id"
                                                            value="{{ $doctor->id }}" />
                                                        @php
                                                            $time = explode('/', $wtime)[0];
                                                            $isBusy = !empty(explode('/', $wtime)[1]);
                                                            $endTime = Carbon\Carbon::create($time);
                                                            $endTime->addMinutes(30);
                                                        @endphp
                                                        <input type="hidden" name="time" value="{{ $time }}" />
                                                        <input type="hidden" name="is_busy"
                                                            value="{{ $isBusy }}" />
                                                        <button
                                                            class="working-time-button  mb-3 btn btn-lg {{ $isBusy ? 'btn-outline-warning' : 'btn-outline-primary' }}">{{ $time }}-{{ $endTime->isoFormat('HH:mm') }}</button>&emsp;
                                                    </form>
                                                @endforeach
                                            </div>
                                        @endif
                                    @endforeach
                                    <div class="card schedule-card busy-card">
                                        <div class="card-body">
                                            <ul class="row">
                                                <div class="col-md-6">
                                                    <li>Patient: &emsp;<span class="name"></span></li>
                                                    <li>Gender: &emsp;<span class="gender"></span></li>
                                                    <li>Date Of Birth: &emsp;<span class="date_of_birth"></span></li>
                                                </div>
                                                <div class="col-md-6">
                                                    <li>Schedule:&emsp; <span class="schedule"></span></li>
                                                </div>

                                                <div class="col-md-12">
                                                    <li>Patient Note: &emsp;<span class="patient_note"></span></li>
                                                </div>
                                                <div class="col-md-12">
                                                    <li>Schedule Note:&emsp; <span class="schedule_note"></span></li>
                                                </div>

                                                <div class="mt-3 text-center col-md-12">
                                                    <a href="" class="btn-detail btn btn-outline-warning">Click
                                                        Here
                                                        To View Detail</a>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card schedule-card empty-card ">
                                        <div class="card-body text-center">
                                            No Event Today
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($doctor->note)
                                <div>
                                    <h5>Note</h5>
                                    <p>{!! $doctor->note !!}</p>
                                </div>
                            @endif
                            @if ($doctor->introduction)
                                <div>
                                    <h5>Introduction</h5>
                                    <p>{!! $doctor->introduction !!}</p>
                                </div>
                            @endif
                            @if ($doctor->training_process)
                                <div>
                                    <h5>Training Process</h5>
                                    <p>{!! $doctor->training_process !!}</p>
                                </div>
                            @endif
                            @if ($doctor->experience_list)
                                <div>
                                    <h5>Experience List</h5>
                                    <p>{!! $doctor->experience_list !!}</p>
                                </div>
                            @endif
                            @if ($doctor->prize_and_research)
                                <div>
                                    <h5>Prizes & Research</h5>

                                    <p>{!! $doctor->prize_and_research !!}</p>
                                </div>
                            @endif
                        </div>


                    </div>

                </div>
                {{-- Edit User Profile --}}
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <form enctype="multipart/form-data" action="{{ route('doctor.profile.profile-update') }}"
                            method="post" class="needs-validation" novalidate="">
                            @csrf
                            <div class="card-header">
                                <h4>Edit User Profile</h4>

                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Save Changes</button>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <img class="rounded-circle mb-5" width="200"
                                            src="{{ asset("$user->avatar") }}" alt="avatar" />
                                    </div>
                                    <div class="form-group col-12">
                                        <input class="form-control" name="avatar" type="file" />
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="form-group col-md-4 col-12">
                                        <label>First Name</label>
                                        <input name="first_name" type="text" class="form-control"
                                            value="{{ $firstName }}" required="">
                                        <div class="invalid-feedback">
                                            Please fill in the first name
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 col-12">
                                        <label>Middle Name</label>
                                        <input name="middle_name" type="text" class="form-control"
                                            value="{{ $middleName }}" required="">
                                        <div class="invalid-feedback">
                                            Please fill in the middle name
                                        </div>

                                    </div>
                                    <div class="form-group col-md-4 col-12">
                                        <label>Last Name</label>
                                        <input name="last_name" type="text" class="form-control"
                                            value="{{ $lastName }}" required="">
                                        <div class="invalid-feedback">
                                            Please fill in the last name
                                        </div>

                                    </div>


                                </div>

                                <div class="row">
                                    <div class="form-group col-md-4 col-12">
                                        <label>Email</label>
                                        <input name="email" type="email" class="form-control"
                                            value="{{ $user->email }}" required="">
                                        <div class="invalid-feedback">
                                            Please fill in the email
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 col-12">
                                        <label>Phone</label>
                                        <input type="tel" name="phone" class="form-control"
                                            value="{{ $user->phone }}">
                                    </div>
                                    <div class="form-group col-md-4 col-12">
                                        <label>Select</label>
                                        <select name="gender" class="form-control">
                                            <option value="1" {{ $user->gender == 1 ? 'selected' : ' ' }}>Male
                                            </option>
                                            <option value="0" {{ $user->gender == 0 ? 'selected' : ' ' }}>Female
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="form-group col-12">
                                        <label>Address</label>
                                        <textarea name="address" class="form-control summernote-simple">
                                    {{ $user->address }}
                                </textarea>

                                    </div>
                                </div>
                                <div class="row">

                                    <div class="form-group col-12">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control summernote-simple">
                                        {{ $user->description }}
                                    </textarea>

                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- Edit Doctor Profile --}}
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">

                        <form enctype="multipart/form-data" action="{{ route('doctor.profile.doctor-profile-update') }}"
                            method="POST">
                            @method('PUT')
                            @csrf
                            <div class="card-header">
                                <h4>Edit Doctor Profile</h4>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Save Changes</button>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Academic Degree</label>
                                    <input value="{{ $doctor->academic_degree }}" name="academic_degree" type="text"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Experience Year</label>
                                    <input value="{{ $doctor->experience_year }}" name="experience_year" type="text"
                                        class="form-control">
                                </div>
                                <div class="form-group ">
                                    <label>Title</label>
                                    <input name="title" class="form-control" value="{{ $doctor->title }}"
                                        type="text" />

                                    </input>
                                </div>
                                <div class="form-group ">
                                    <label>Note</label>
                                    <textarea name="note" class="form-control summernote">
                                        {{ $doctor->note }}
                                    </textarea>
                                </div>
                                <div class="form-group ">
                                    <label>Introduction</label>
                                    <textarea name="introduction" class="form-control summernote">
                                        {{ $doctor->introduction }}
                                    </textarea>
                                </div>
                                <div class="form-group ">
                                    <label>Training Process</label>
                                    <textarea name="training_process" class="form-control summernote">
                                        {{ $doctor->training_process }}
                                    </textarea>
                                </div>
                                <div class="form-group ">
                                    <label>Experience List</label>
                                    <textarea name="experience_list" class="form-control summernote">
                                        {{ $doctor->experience_list }}
                                    </textarea>
                                </div>
                                <div class="form-group ">
                                    <label>Prize And Research</label>
                                    <textarea name="prize_and_research" class="form-control summernote">
                                        {{ $doctor->prize_and_research }}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label>Specialization</label>
                                    <ul>
                                        @foreach ($doctor->specializations as $s)
                                            <li>{{ $s->name }}</li>
                                        @endforeach
                                    </ul>
                                    <select name="specialization_id[]" class="form-control select2" multiple="multiple">
                                        @foreach ($specializations as $s)
                                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label>Workplace</label>
                                    <select name="workplace_id" class="form-control" m>
                                        @foreach ($workplaces as $w)
                                            <option {{ $doctor->workplace_id == $w->id ? 'selected' : '' }}
                                                value="{{ $w->id }}">{{ $w->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary">Save Changes</button>
                                </div>

                            </div>
                        </form>

                    </div>

                </div>
                {{-- Edit password --}}
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <form enctype="multipart/form-data" action="{{ route('doctor.profile.password-update') }}"
                            method="post" class="needs-validation" novalidate="">
                            @csrf
                            <div class="card-header">
                                <h4>Update Password</h4>

                            </div>

                            <div class="card-body">
                                <div class="row">


                                    <div class="form-group col-md-12 col-12">
                                        <label>Current Password</label>
                                        <input name="current_password" type="password" class="form-control"
                                            placeholder="Enter your current password" required="">
                                        <div class="invalid-feedback">
                                            Please fill in the password
                                        </div>

                                    </div>
                                    <div class="form-group col-md-12 col-12">
                                        <label>New Password</label>
                                        <input name="password" type="password" class="form-control"
                                            placeholder="Enter new password" required="">
                                        <div class="invalid-feedback">
                                            Please fill in the password
                                        </div>

                                    </div>
                                    <div class="form-group col-md-12 col-12">
                                        <label>Password Confirmation</label>
                                        <input name="password_confirmation" type="password"
                                            placeholder="Password confirmation" class="form-control" required="">
                                        <div class="invalid-feedback">
                                            Please fill in the password confirmation
                                        </div>

                                    </div>


                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $(".schedule-card").hide();
            $(".nav-link").on("click", function() {
                $(".schedule-card").hide();
                $(".tab-pane").removeClass("show active");
                const id = $(this).attr("id");
                const tabID = id.substring(0, id.length - 4);
                $(".tab-pane-" + tabID).addClass("show active");
            });


            $("form").on("submit", function(e) {
                $(".schedule-card").hide(500);
                e.preventDefault();
                const isBusy = $(e.currentTarget[3]).val();
                const button = $(this).find("button");
                const dataHTML = $(button).html();
                if (!isBusy) {
                    $(".empty-card").slideToggle(500);
                    return;
                }
                const data = $(this).serialize();
                $.ajax({
                    type: "GET",
                    url: "{{ route('doctor.working-time.get-working-time') }}",
                    data: data,
                    dataType: "JSON",
                    beforeSend: function() {
                        $(button).html(`<i class="fas fa-spinner fa-pulse"></i>`)
                        $(button).attr("disabled", true)
                    },
                    success: function(data) {
                        $(button).html(dataHTML);
                        $(button).attr("disabled", false)
                        $(".schedule").html(data.schedule);
                        $(".name").html(data.name);
                        $(".date_of_birth").html(data.date_of_birth);
                        $(".gender").html(data.gender);
                        $(".note").html(data.note);
                        $(".patient_note").html(data.patient_note);
                        $(".schedule_note").html(data.schedule_note);
                        $(".gender").html(!data.gender ? "Female" : "Male");
                        $(".busy-card").slideToggle(500);
                        $(".btn-detail").attr("href", data.url);
                    },
                });
            });
        });
    </script>
@endpush
