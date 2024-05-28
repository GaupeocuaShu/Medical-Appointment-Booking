@extends('frontend.layout.master')
@section('content')
    <!-- NEWS DETAIL -->
    <section id="news-detail" data-stellar-background-ratio="0.5">
        <div class="container">
            <div style="margin-bottom:2rem">
                <button onclick="window.location.href='/'">Trở lại</button>
            </div>
            <div class="row">
                <div class="col-md-8 col-sm-7">
                    <!-- NEWS THUMB -->
                    <div class="news-detail-thumb">
                        <div class="news-image">
                            <img src="{{ asset($post->thumb_image) }}" class="img-responsive" alt="">
                        </div>
                        {{-- News Detail --}}
                        <div class="news-content">
                            {!! $post->content !!}
                        </div>
                        {{-- News Detail --}}
                        <div class="news-social-share">
                            <h4>Share this article</h4>
                            <a href="#" class="btn btn-primary"><i class="fa fa-facebook"></i>Facebook</a>
                            <a href="#" class="btn btn-success"><i class="fa fa-twitter"></i>Twitter</a>
                            <a href="#" class="btn btn-danger"><i class="fa fa-google-plus"></i>Google+</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-5">
                    <div class="news-sidebar">
                        <div class="news-author">
                            <h4>About the author</h4>
                            <div class="doctor-introduction"><!-- Phần giới thiệu bác sĩ -->
                                <div style="text-align: center"><img style="border-radius: 100%;margin-right:10px"
                                        width="100" alt="{{ getFullName($creator) }}"
                                        src="{{ asset($creator->avatar) }}" /></div>
                                <div class="doctor-profile">

                                    <div>
                                        <h3 class="font-weight-bold">
                                            {{ $creator->doctor->academic_degree . ' ' . getFullName($creator) }}</h3>
                                        <br>
                                        <div><span>Chuyên Khoa</span> &ensp;
                                            @foreach ($creator->doctor->specializations as $s)
                                                <span class="text-primary font-weight-bold">
                                                    {{ $s->name }} &emsp13;
                                                </span>
                                            @endforeach
                                        </div>
                                        <div>
                                            <span>Phòng Khám</span> &emsp;
                                            <span class="text-primary font-weight-bold">
                                                {{ $creator->doctor->workplace->name }} &emsp13;
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="recent-post">
                            <h4>Bài viết gần đây</h4>
                            @foreach ($postsByCreator as $post)
                                <div class="media">
                                    <div class="media-object pull-left">
                                        <a href="#"><img src="{{ asset($creator->avatar) }}" class="img-responsive"
                                                alt=""></a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading"><a
                                                href="{{ route('news-detail', $post->id) }}">{{ $post->title }}</a>
                                        </h4>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="news-categories">
                            <h4>Categories</h4>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Dental</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Cardiology</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Health</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Consultant</a></li>
                        </div>

                        <div class="news-ads sidebar-ads">
                            <h4>Sidebar Banner Ad</h4>
                        </div>

                        <div class="news-tags">
                            <h4>Tags</h4>
                            <li><a href="#">Pregnancy</a></li>
                            <li><a href="#">Health</a></li>
                            <li><a href="#">Consultant</a></li>
                            <li><a href="#">Medical</a></li>
                            <li><a href="#">Doctors</a></li>
                            <li><a href="#">Social</a></li>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
