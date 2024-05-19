@extends('frontend.layout.master')
@section('content')
    <!-- Main container  -->
    <div class="container">
        <div class="row">
            <div style="margin-top:1rem ;display:flex; justify-content:space-between;align-items:center">
                <h4>Danh sách các chuyên khoa</h4>

                <div><button onclick="window.location.href='/'">Trở lại</button></div>

            </div>
            <div class="doctor-list">
                <ul>
                    @foreach ($specializations as $s)
                        <li data-url="{{ route('specialization-book', $s->id) }}" class="specialization-card wow fadeInUp"
                            data-wow-delay="0.4s">
                            <img class="specialization-image " src="{{ asset($s->image) }}" alt="Avatar">
                            <div>
                                <h5>{{ $s->name }}</h5>
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
        .specialization-card {
            cursor: pointer;
            background-color: #83bad430 !important;
        }

        .specialization-image {
            width: 170px !important;
            height: 170px !important;
            border-radius: 50%;
            object-fit: cover
        }
    </style>
@endpush



@push('scripts')
    <script>
        $(".book-appointment").on("click", function() {
            window.location.href = $(this).data("url");
        });
        $(".specialization-card").on("click", function() {
            window.location.href = $(this).data("url");
        });
    </script>
@endpush
