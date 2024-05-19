<!-- Specializations -->

<section id="news" data-stellar-background-ratio="2.5">

    <div class="container">
        <div class="row">

            <div class="col-md-12 col-sm-6" style="display: flex;justify-content:space-between;align-items:center">
                <div class="about-info">
                    <h4 class="wow fadeInUp" data-wow-delay="0.1s">Chuyên Khoa</h4>
                </div>
                <button onclick="window.location.href='{{ route('specialization-list') }}'">Xem Thêm</button>
            </div>

            <div class="clearfix"></div>

            <div class="swiper mySwiper specialization-swiper">
                <div class="swiper-wrapper">
                    @foreach ($specializations as $s)
                        <div style="background-color: white" data-url="{{ route('specialization-book', $s->id) }}"
                            class=" wow fadeInUp swiper-slide specialization-swiper-slide" data-wow-delay="0.4s">
                            <img src="{{ asset($s->image) }}" alt="Avatar">
                            <h5>{{ $s->name }}</h5>
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
        .specialization-swiper {
            width: 100%;
            height: 350px;
        }

        .specialization-swiper-slide {
            display: flex;
            flex-direction: column;
            justify-content: center !important;
            height: 100% !important;
            align-items: center;
            border: 1px solid rgba(104, 104, 104, 0.355);
            overflow: hidden;
            border-radius: 10px;
            cursor: pointer;
        }

        .specialization-swiper-slide img {
            display: block;
            object-fit: cover;
            width: 90%;
            margin-bottom: 2rem
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(".book-appointment").on("click", function() {
            window.location.href = $(this).data("url");
        });

        $(".specialization-swiper-slide").on("click", function() {
            window.location.href = $(this).data("url");

        });
    </script>
@endpush
