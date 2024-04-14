@extends('doctor.layout.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Working Time</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Profile</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Working Time Table</h4>
                    <div class="card-header-action">
                        <div class="input-group-btn">
                            <a href="{{ route('doctor.working-time.edit') }}"><button class="btn btn-primary"><i
                                        class="fa-solid fa-plus"></i></button></a>
                        </div>

                    </div>
                </div>
                <div class="card-body">

                    <div>
                        @php
                            $flag = 0;
                        @endphp
                        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                            @foreach ($datesFrWTime as $key => $wTimes)
                                @php
                                    $date = Carbon\Carbon::create($key);
                                    $currentDate = Carbon\Carbon::now();
                                @endphp
                                @if ($date->greaterThan($currentDate))
                                    @if ($flag == 0)
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
                                    @php
                                        $flag++;
                                    @endphp
                                @endif
                            @endforeach
                        </ul>
                        @php
                            $flag = 0;
                        @endphp
                        <div class="tab-content mb-4" id="myTabContent">
                            @foreach ($datesFrWTime as $key => $wTimes)
                                @php
                                    $date = Carbon\Carbon::create($key);
                                    $currentDate = Carbon\Carbon::now();
                                @endphp
                                @if ($date->greaterThan($currentDate))
                                    @if ($flag == 0)
                                        <div class="tab-pane tab-pane-{{ $key }} fade show active "
                                            id="{{ $key }}" role="tabpanel"
                                            aria-labelledby="{{ $key }}-tab">
                                            @foreach ($wTimes as $wtime)
                                                <form class="get-working-time-form" action="" style="display: inline">
                                                    <input type="hidden" name="date" value="{{ $key }}" />
                                                    <input type="hidden" name="doctor_id" value="{{ $doctor->id }}" />
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
                                        <div class="tab-pane tab-pane-{{ $key }} fade" id="{{ $key }}"
                                            role="tabpanel" aria-labelledby="{{ $key }}-tab">
                                            @foreach ($wTimes as $wtime)
                                                <form class="get-working-time-form" action="" style="display: inline">
                                                    <input type="hidden" name="date" value="{{ $key }}" />
                                                    <input type="hidden" name="doctor_id" value="{{ $doctor->id }}" />
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
                                    @php
                                        $flag++;
                                    @endphp
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

            $(".get-working-time-form").on("submit", function(e) {
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
