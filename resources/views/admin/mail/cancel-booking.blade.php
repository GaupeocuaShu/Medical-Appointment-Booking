@php
    use Illuminate\Support\Carbon;
    use App\Models\Doctor;
    $user = auth()->user();
    $doctor = Doctor::with('workplace', 'user')->findOrFail($schedule->doctor_id);
@endphp
<!DOCTYPE html>
<html lang="vi">

<head>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f0f2f5;
            color: #333;
        }

        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            margin: 40px auto;
            border: 1px solid #d9d9d9;
        }

        h2 {
            color: #0e6bcd;
            border-bottom: 2px solid #0e6bcd;
            padding-bottom: 10px;
        }

        h3 {
            color: #0e6bcd;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        p {
            margin: 10px 0;
            line-height: 1.8;
        }

        .info {
            margin-bottom: 20px;
        }

        .info p {
            margin: 5px 0;
        }

        .highlight {
            font-weight: bold !important;
            color: #0e6bcd !important;
        }

        .highlight-cancel {
            font-weight: bold;
            color: rgb(216, 59, 23);
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #d9d9d9;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Kính gửi bệnh nhân {{ getFullName($user) }},</h2>

        <p>Chúng tôi rất tiếc phải thông báo rằng lịch khám bệnh của quý khách đã bị hủy. Dưới đây là chi tiết về lịch
            khám đã bị hủy của quý khách:</p>
        <div class="info">
            <h3>Thông tin lịch khám:</h3>
            <p>Ngày khám: <span
                    class="highlight">{{ Carbon::create($schedule->appointment)->isoFormat('D/MM/YYYY') }}</span></p>
            <p>Giờ khám: <span class="highlight">{{ Carbon::create($schedule->appointment)->isoFormat('HH:mm') }}</span>
            </p>
            <p>Địa điểm: <span class="highlight">{{ $doctor->workplace->name }} - {!! getWorkplaceAddress($doctor->workplace) !!}</span></p>
            <p>Trạng thái: <span class="highlight-cancel">Đã hủy</span></p>
        </div>
        <div class="info">
            <h3>Thông tin bệnh nhân:</h3>
            <p>Mã phiếu khám: <span class="highlight"> {{ $schedule->id }}</span></p>
            <p>Mã bệnh nhân: <span class="highlight">{{ $user->patient->patient_id }}</span></p>
            <p>Họ và tên: <span class="highlight">{{ getFullName($user) }}</span></p>
            <p>Ngày sinh: <span class="highlight">{{ $user->date_of_birth }}</span></p>
            <p>Số điện thoại: <span class="highlight">{{ $user->phone }}</span></p>
        </div>
        <div class="info">
            <h3>Thông tin bác sĩ:</h3>
            <p>Họ và tên: <span class="highlight">{{ getFullName($doctor->user) }}</span></p>
            <p>Số điện thoại: <span class="highlight">{{ $doctor->user->phone }}</span></p>
            <p>Email: <span class="highlight">{{ $doctor->user->email }}</span></p>
        </div>

        <p>Nếu quý khách có bất kỳ thắc mắc hoặc cần hỗ trợ, xin vui lòng liên hệ với chúng tôi qua số điện thoại <span
                class="contact-info">0707600463</span> hoặc email <span
                class="contact-info">mediclord0106@gmail.com</span>.</p>

        <p>Chúng tôi xin lỗi vì sự bất tiện này và rất mong được phục vụ quý khách vào lần sau.</p>

        <p class="footer">Trân trọng,<br><strong>Mediclord</strong></p>
    </div>
</body>

</html>
