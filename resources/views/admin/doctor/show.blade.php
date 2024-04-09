@extends('admin.layout.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Doctor</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Doctor</a></div>
                <div class="breadcrumb-item">Show</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Doctor Details</h2>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle mr-5 mb-5 object-cover" width="200"
                                    alt="{{ getFullName($doctor->user) }}" src="{{ asset($doctor->user->avatar) }}" />
                                <div>
                                    <h3 class="font-weight-bold">
                                        {{ $doctor->academic_degree . ' ' . getFullName($doctor->user) }}</h3>
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
                                                        <input type="hidden" name="is_busy" value="{{ $isBusy }}" />
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
                            <a href="{{ route('admin.doctor.index') }}" class="btn btn-danger"><i
                                    class="fa-solid fa-right-from-bracket"></i>&emsp;Back</a>
                        </div>


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
                    url: "{{ route('admin.doctor.get-working-time') }}",
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
