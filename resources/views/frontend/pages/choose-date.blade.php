@extends('frontend.layout.master')
@section('content')
    <!-- Main container  -->
    <div class="container">

        <div class="doctor-introduction"><!-- Phần giới thiệu bác sĩ -->
            <div class="doctor-profile">
                <img width="200" alt="{{ getFullName($doctor->user) }}" src="{{ asset($doctor->user->avatar) }}" />
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

        </div>

        <!-- Phần thông tin phòng khám -->
        <div class="clinic-information">
            <h3>Địa chỉ khám</h3>
            <p>Bệnh viện Đa Khoa tỉnh Khánh Hòa</p>
            <p>19 Yersin, P. Lộc Thọ, TP. Nha Trang</p>
            <p><span class="promotion">Chương trình khuyến mãi</span> <a href="#" class="detail-link">Xem chi
                    tiết</a></p>
            <p>Giá khám: 150.000đ <a href="#" class="detail-link">Xem chi tiết</a></p>
            <p>Loại bảo hiểm áp dụng <a href="#" class="detail-link">Xem chi tiết</a></p>

        </div>
        <div class="booking-area">
            <!-- Bảng ngày để đặt lịch -->
            <div class="calendar-container">
                <div class="month">
                    <button id="prev" class="prev">&#10094;</button>
                    <h3>Tháng {{ $currentMonth }}, {{ $currentYear }}</h3>
                    <button id="next" class="next">&#10095;</button>
                </div>
                <div class="days">
                    <div class="day">T2</div>
                    <div class="day">T3</div>
                    <div class="day">T4</div>
                    <div class="day">T5</div>
                    <div class="day">T6</div>
                    <div class="day">T7</div>
                    <div class="day">CN</div>
                </div>
                <div class="dates" id="dates">
                    <!-- JavaScript sẽ điền các ngày vào đây -->
                </div>
                <div class="calendar-legend">
                    <span class="legend-item"><span class="legend-color available"></span> Ngày đặt khám được</span>
                    <span class="legend-item"><span class="legend-color unavailable"></span> Ngày không đặt khám
                        được</span>
                </div>

                <button id="confirmDate" class="confirm-date">Xác nhận chọn ngày</button>
            </div>

            <!-- Bảng Gio để đặt lịch -->
            <div class="time-container">
                <section class="data-loader hidden">
                    <div class="spinner">
                        <span class="spinner-rotate"></span>
                    </div>
                </section>
                <div class="time-container-background">
                    <img width="120" src="{{ asset('uploads/shop.png') }}" />
                </div>
                <div>
                    <div class="morning time-section hidden">
                        <h4>Buổi Sáng</h4>
                        <div class="time-selection">
                        </div>
                    </div>
                    <div class="afternoon time-section hidden">
                        <h4>Buổi Chiều</h4>
                        <div class="time-selection">
                        </div>
                    </div>
                    <div class="evening time-section hidden">
                        <h4>Buổi Tối</h4>
                        <div class="time-selection">
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>

    <!-- Main container  -->
@endsection


@push('scripts')
    <script>
        // Mảng ví dụ, true nghĩa là ngày có thể đặt lịch, false là không thể
        let availability = '{!! $jsonDatesFrWTime !!}';
        const currentMonth = "{{ $currentMonth }}";
        const currentYear = "{{ $currentYear }}";
        let selectedDate = null; // Lưu trữ ngày được chọn
        const doctorID = "{{ $doctor->id }}";
        const daysInMonth = new Date(currentYear, parseInt(currentMonth), 0).getDate();
        const datesContainer = document.getElementById('dates');
        let dates = [];
        availability = JSON.parse(availability);

        for (let i = 1; i <= daysInMonth; i++) {
            if (availability[i] == true) dates[i] = true;
            else dates[i] = false;
        }
        console.log(dates);
        // Tạo và hiển thị các ngày
        dates.forEach((available, index) => {
            const dateElement = document.createElement('div');
            dateElement.classList.add('date');
            if (!available) {
                dateElement.classList.add('disabled');
            } else {
                dateElement.classList.add('active');
                dateElement.addEventListener('click', function() {
                    if (selectedDate) {
                        selectedDate.classList.remove('selected'); // Xóa lựa chọn trước đó
                    }
                    dateElement.classList.add('selected'); // Đánh dấu ngày được chọn
                    selectedDate = dateElement;
                });
            }
            dateElement.textContent = index; // Ngày bắt đầu từ 1
            datesContainer.appendChild(dateElement);
        });

        // Xử lý sự kiện khi nhấn nút xác nhận
        $("#confirmDate").on("click", function() {
            const data = {
                current_month: currentMonth,
                current_year: currentYear,
                doctor_id: doctorID,
                selected_date: $(selectedDate).html(),
            }
            $.ajax({
                type: "POST",
                url: "{{ route('get-time-frame-by-date') }}",
                data: data,
                dataType: "JSON",
                beforeSend: function() {
                    $(".data-loader").removeClass("hidden");
                    $(".time-container-background").hide();
                    $(".time-section").addClass("hidden");
                },
                success: function(response, textStatus, jqXHR) {
                    const timeFrames = response.time_frames;

                    $(".time-selection").html('');
                    $(".data-loader").addClass("hidden");

                    function removeClassHidden(a) {
                        $(a).removeClass("hidden");
                    }
                    $.each(timeFrames, function(i, v) {
                        const timeSection = parseInt(v.slice(0, 2));
                        const timeFrameHTML = `<div class="time-frame">${v}</div>`;
                        if (timeSection < 12) {
                            removeClassHidden(".morning");
                            $(".morning .time-selection").append(
                                timeFrameHTML);
                        } else if (timeSection > 12 && timeSection < 17) {
                            removeClassHidden(".afternoon");
                            $(".afternoon .time-selection").append(
                                timeFrameHTML);
                        } else {
                            removeClassHidden(".evening");
                            $(".evening .time-selection").append(
                                timeFrameHTML);
                        };
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.table(jqXHR)
                }
            });
        });
    </script>
@endpush
