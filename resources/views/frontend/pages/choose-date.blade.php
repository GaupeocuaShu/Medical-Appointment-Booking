@extends('frontend.layout.master')
@section('content')
    <!-- Main container  -->
    <div class="container">

        <div class="doctor-introduction"><!-- Phần giới thiệu bác sĩ -->
            <div class="doctor-profile">
                <img src="images/quoc.jpg" alt="Doctor" class="doctor-image">
                <h3>Dr. Dương Trung Quốc</h3>
            </div>
            <p>Chuyên khoa: Tim mạch</p>
            <div class="doctor-location">
                <i class="fa fa-map-marker" aria-hidden="true"></i> Nha Trang
            </div>
        </div>


        <!-- Bảng ngày để đặt lịch -->
        <div class="calendar-container">
            <div class="month">
                <button id="prev" class="prev">&#10094;</button>
                <h3>Tháng 4, 2024</h3>
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

    </div>

    <!-- Main container  -->
@endsection


@push('scripts')
    <script>
        // Mảng ví dụ, true nghĩa là ngày có thể đặt lịch, false là không thể
        const availability = [false, true, true, true, false, true, true, false, true, true, false, true, true, true,
            false, true, true, true, false, true, true, true, false, true, true, true, false, true, true, false
        ];

        const datesContainer = document.getElementById('dates');
        let selectedDate = null; // Lưu trữ ngày được chọn

        // Tạo và hiển thị các ngày
        availability.forEach((available, index) => {
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
            dateElement.textContent = index + 1; // Ngày bắt đầu từ 1
            datesContainer.appendChild(dateElement);
        });

        // Xử lý sự kiện khi nhấn nút xác nhận
        document.getElementById('confirmDate').addEventListener('click', function() {
            if (selectedDate) {
                // Thực hiện hành động chuyển trang hoặc lưu ngày được chọn
                alert('Ngày được chọn: ' + selectedDate.textContent); // Ví dụ hiển thị thông báo
                window.location.href = '../ChooseTime/index.html';
            } else {
                alert('Vui lòng chọn ngày khám bệnh.');
            }
        });
    </script>
@endpush
