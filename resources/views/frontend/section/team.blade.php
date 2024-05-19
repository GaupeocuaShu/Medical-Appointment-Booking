<!-- TEAM -->
<section id="team" data-stellar-background-ratio="1">
    <div class="container">
        <div class="row">

            <div class="col-md-12 col-sm-6" style="display: flex;justify-content:space-between;align-items:center">
                <div class="about-info">
                    <h4 class="wow fadeInUp" data-wow-delay="0.1s">Đặt khám bác sĩ</h4>
                </div>
                <button onclick="window.location.href='{{ route('doctor-team') }}'">Xem Thêm</button>
            </div>

            <div class="clearfix"></div>

            <div class="swiper mySwiper doctor-swiper">
                <div class="swiper-wrapper">
                    @foreach ($doctors as $dr)
                        <div class="doctor-item wow fadeInUp swiper-slide doctor-swiper-slide" data-wow-delay="0.4s">
                            <img src="{{ asset($dr->user->avatar) }}" style="border-radius: 100%" width="100"
                                height="100" alt="Avatar">
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
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
</section>

@push('styles')
    <style>
        .doctor-swiper {
            width: 100%;
            height: 350px;
        }

        .doctor-swiper-slide {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100% !important;
        }

        .doctor-swiper-slide img {
            display: block;
            object-fit: cover;
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
