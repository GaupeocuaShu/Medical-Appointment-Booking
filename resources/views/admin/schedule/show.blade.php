@extends('admin.layout.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Schedule</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Schedule</div>
            </div>
        </div>

        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title">
                                <h2>Schedule</h2>
                                <div class="invoice-number">Schedule ID #{{ $schedule->id }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Patient:</strong><br>
                                        {{ getFullName($user) }}<br>
                                        {!! $user->address !!}
                                        {{ $user->phone }}<br>
                                        {{ $user->gender == 0 ? 'Female' : 'Male' }}<br><br>
                                    </address>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong>Doctor:</strong><br>
                                        {{ $doctor->doctor->academic_degree . ' ' . getFullName($doctor) }}<br>
                                        {{ $doctor->phone }}<br>
                                        @foreach ($doctor->doctor->specializations as $specialization)
                                            {{ $specialization->name }} &emsp;
                                        @endforeach
                                        <br><br>
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Appointment:</strong><br>
                                        @php
                                            $date = Carbon\Carbon::create($schedule->appointment);
                                        @endphp
                                        {{ $date->isoFormat('DD-MM-YYYY | hh:mm') }}<br><br>
                                        <span style="text-transform: uppercase;color:white"
                                            class="badge bg-dark">{{ $schedule->status }}</span><br>
                                    </address>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong>Book Date:</strong><br>
                                        @php
                                            $date = Carbon\Carbon::create($schedule->created_at);
                                        @endphp
                                        {{ $date->isoFormat('DD-MM-YYYY | hh:mm') }}<br><br>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <hr>
                <div class="text-md-right">
                    <div class="float-lg-left mb-lg-0 mb-3">
                        <a href="{{ route('admin.schedule.pending-schedule') }}"
                            class="btn btn-danger btn-icon icon-left"><i class="fa-solid fa-right-from-bracket"></i>
                            Back</a>
                    </div>
                    <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
@endpush
