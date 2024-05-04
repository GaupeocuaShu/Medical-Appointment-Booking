@extends('frontend.layout.master')
@section('content')
    <!-- Main container  -->
    <div class="container">
        <div class="row">
            <div style="margin-top:1rem ;display:flex; justify-content:space-between;align-items:center">
                <h4>Danh sách các bác sĩ</h4>

                <div><button onclick="window.location.href='/'">Trở lại</button></div>

            </div>
            <div class="doctor-list">
                <ul>
                    @foreach ($doctors as $dr)
                        <li class=" wow fadeInUp" data-wow-delay="0.4s">
                            <img src="{{ asset($dr->user->avatar) }}" style="border-radius: 100%" width="100" height="100"
                                alt="Avatar">
                            <div class="doctor-list-infor">
                                <h4>{{ $dr->academic_degree }} {{ getFullName($dr->user) }}</h4>
                                <h5>
                                    @foreach ($dr->specializations as $sp)
                                        {{ ' ' . $sp->name }}
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach

                                </h5>
                                <p>{{ $dr->workplace->name }}</p>
                                <div><button data-url="{{ route('book-appointment', $dr->id) }}"
                                        class="book-appointment">Đặt
                                        lịch</button>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
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



@push('scripts')
    <script>
        $(".book-appointment").on("click", function() {
            window.location.href = $(this).data("url");
        });
    </script>
@endpush
