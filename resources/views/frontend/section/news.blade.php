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

            @foreach ($posts as $post)
                <div class="col-md-4 col-sm-6">
                    <!-- NEWS THUMB -->
                    <div class="news-thumb wow fadeInUp" data-wow-delay="0.4s">
                        <a href="news-detail.html">
                            <img src="{{ asset($post->thumb_image) }}" class="img-responsive" alt="">
                        </a>
                        <div class="news-info">
                            <span>{{ $post->created_at }}</span>
                            <h3><a href="news-detail.html">{{ $post->title }}</a></h3>
                            <p>{!! $post->short_description !!}</p>
                            <div class="author">
                                <img src="{{ asset($post->user->avatar) }}" class="img-responsive" alt="">
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
    </div>
</section>
