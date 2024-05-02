@php
    use Illuminate\Support\Carbon;

@endphp

<!-- NEWS -->
<section id="news" data-stellar-background-ratio="2.5">
    <div class="container">
        <div class="row">

            <div class="col-md-12 col-sm-12">
                <!-- SECTION TITLE -->
                <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                    <h2>Tin Y tế</h2>
                </div>
            </div>

            <div>
                <div class="swiper mySwiper news-swiper ">
                    <div class="swiper-wrapper">
                        @foreach ($posts as $post)
                            <div class="col-md-4 col-sm-6 swiper-slide news-swiper-slider">
                                <!-- NEWS THUMB -->
                                <div class="news-thumb wow fadeInUp" data-wow-delay="0.4s">
                                    <a href="{{ route('news-detail', $post->id) }}">
                                        <img src="{{ asset($post->thumb_image) }}" class="img-responsive"
                                            alt="">
                                    </a>
                                    <div class="news-info">
                                        <div style="padding: 10px 0">
                                            {{ Carbon::create($post->created_at)->isoFormat('DD/MM/YYYY') }}
                                        </div>
                                        <div
                                            style="height: 80px;overflow:hidden;font-size:1.7rem;
                                    font-weight:600">
                                            <a href="{{ route('news-detail', $post->id) }}">{{ $post->title }}</a>
                                        </div>
                                        <div style="height: 150px;overflow:hidden">{!! $post->short_description !!}</div>
                                        <div style="height: 120px;overflow:hidden" class="author">
                                            <img src="{{ asset($post->user->avatar) }}" class="img-responsive"
                                                alt="">
                                            <div class="author-info">
                                                <h5>{{ getFullName($post->user) }}</h5>
                                                <p>{{ $post->user->doctor->title }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>
</section>



@push('styles')
    <style>
        .news-swiper {
            width: 100%;
            height: 580px;
        }

        .news-swiper-slide {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100% !important;
        }

        .news-swiper-slide img {
            display: block;
            object-fit: cover;
        }
    </style>
@endpush
