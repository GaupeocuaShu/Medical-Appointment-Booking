@php
    use Illuminate\Support\Carbon;
@endphp
@extends('frontend.layout.master')
@section('content')
    <!-- Main container  -->
    <div class="container">
        <div class="row">
            <!-- Schedule -->
            <div style="display:flex;justify-content:space-between;align-items:center">
                <h2 style="color:#4CAF50">Lịch Trình</h2>
                <div><button onclick="window.location.href='/'">Trở lại</button></div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Tên bệnh nhân</th>
                        <th>Tên bác sĩ</th>
                        <th>Ngày khám</th>
                        <th>Giờ khám</th>
                        <th>Chi tiết</th>
                        <th>Trạng thái</th>
                        <th>Hủy</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mySchedules as $s)
                        <tr>
                            <td>{{ getFullName($s->user) }}</td>
                            <td>{{ getFullName($s->doctor->user) }}</td>
                            <td>{{ Carbon::create($s->appointment)->isoFormat('DD-MM-YYYY') }}</td>
                            <td>{{ Carbon::create($s->appointment)->isoFormat('HH:mm') }}</td>
                            <td><button class="details-button"
                                    onclick="window.location.href='{{ route('booking-success', $s->id) }}';"><i
                                        class="fa fa-exclamation-circle"></i> Chi Tiết</button></td>
                            <td class="schedule-status-{{ $s->id }}">
                                @if ($s->status == 'canceled')
                                    Đã Hủy
                                @elseif($s->status == 'pending')
                                    Đang duyệt
                                @elseif($s->status == 'completed')
                                    Đã khám xong
                                @else
                                    Đã duyệt
                                @endif
                            </td>
                            @if ($s->status != 'canceled' && $s->status != 'completed')
                                <td><button data-id="{{ $s->id }}" class="cancel-button"
                                        onclick="confirmCancellation();"><i class="fa fa-times-circle"></i></button></td>
                            @endif
                        </tr>
                    @endforeach

                </tbody>
            </table>


        </div>
    </div>
    <!-- Main container  -->
@endsection


@push('styles')
    <style>
        .doctor-list-infor {
            display: flex;
            flex-direction: column
        }
    </style>
@endpush


@push('styles')
    <style>
        .swal2-popup {
            font-size: 1.5rem !important;
        }
    </style>
@endpush
@push('scripts')
    <script>
        $(".book-appointment").on("click", function() {
            window.location.href = $(this).data("url");
        });
    </script>


    <script>
        $(".cancel-button").on("click", function() {
            const scheduleID = $(this).data('id');
            Swal.fire({
                title: "Yêu Cầu Hủy Lịch",
                text: "Lịch hẹn sẽ không được khôi phục",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Hủy Lịch",
                cancelButtonText: "Quay Lại",

            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "PUT",
                        url: "{{ route('cancel-appontment') }}",
                        data: {
                            id: scheduleID,
                        },
                        dataType: "JSON",
                        success: (response, textStatus, jqXHR) => {
                            if (response.status == "success") {
                                Swal.fire({
                                    title: "Đã Hủy",
                                    text: response.message,
                                    icon: "success"
                                });
                                $('.schedule-status-' + scheduleID).html('Đã Hủy');
                                $(this).parent().hide();
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.table(jqXHR)
                        }
                    });

                }
            });
        });
    </script>
@endpush
