@php
    use Illuminate\Support\Carbon;

@endphp
@extends('frontend.layout.master')
@section('content')
    <!-- Main container  -->
    <div class="container">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <div class="appointment-card">
                    <div class="appointment-head">

                        <div class="appointment-details">
                            <img src="{{ asset('uploads/qr.png') }}" alt="Mã QR" class="qr-code">
                            <p><img src="{{ asset('uploads/tic.jpeg') }}" alt="icon confirm" class="confirm-icon"
                                    style="width: 20px; height: 20px;"> Đã đặt lịch</p>
                            <p>Mã phiếu khám: {{ $schedule->id }}</p>
                            <p>Mã bệnh nhân: {{ $schedule->patient_id }}</p>
                            <p>Ngày khám: {{ Carbon::create($schedule->appointment)->isoFormat('D/MM/YYYY') }}</p>
                            <p>Giờ khám dự kiến:
                                @php
                                    $sTime = Carbon::create($schedule->appointment);
                                    $eTime = $sTime->copy()->addMinutes(30);
                                @endphp
                                {{ $sTime->isoFormat('HH:mm') . '-' . $eTime->isoFormat('HH:mm') }}
                            </p>
                            <p>{{ $doctor->workplace->name }}</p>
                            <p>{!! getWorkplaceAddress($doctor->workplace) !!}</p>
                        </div>
                    </div>
                    <div class="patient-info">
                        <h3>Thông tin bệnh nhân</h3>
                        <p>Họ và tên: {{ getFullName($user) }}</p>
                        <p>Số điện thoại:{{ $user->phone }}</p>
                        <p>Email:{{ $user->email }}</p>
                    </div>
                    <div class="patient-info">
                        <h3>Thông tin bác sĩ</h3>
                        <p>Họ và tên: {{ getFullName($doctor->user) }}</p>
                        <p>Số điện thoại:{{ $doctor->user->phone }}</p>
                        <p>Email:{{ $doctor->user->email }}</p>
                    </div>
                </div>
                <div style="margin-top:2rem;display:flex;justify-content:space-between">
                    <button onclick="window.location.href='/'"><i class="fa-solid fa-house"></i>&ensp;Trang Chủ</button>
                    <button onclick="window.location.href='{{ route('my-appointment') }}'"><i
                            class="fa-regular fa-calendar-check"></i>&ensp;Lịch
                        Hẹn</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Main container  -->
@endsection


@push('scripts')
@endpush
