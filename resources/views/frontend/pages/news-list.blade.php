@php
    use Illuminate\Support\Carbon;
@endphp
@extends('frontend.layout.master')
@section('content')
    <!-- Main container  -->
    <div class="container">
        <div class="row">
            <div style="margin-top:1rem ;display:flex; justify-content:space-between;align-items:center">
                <h4>Danh Sách Tin Tức</h4>
                <div><button onclick="window.location.href='/'">Trở lại</button></div>
            </div>

            <div class="news-list">
                @foreach ($posts as $post)
                    <div class="news-thumb wow fadeInUp" data-wow-delay="0.4s">
                        <a href="{{ route('news-detail', $post->id) }}">
                            <img src="{{ asset($post->thumb_image) }}" class="img-responsive" alt="">
                        </a>
                        <div class="news-info">
                            <div style="padding: 10px 0">
                                {{ Carbon::create($post->created_at)->isoFormat('DD/MM/YYYY') }}
                            </div>
                            <div style="height: 80px;overflow:hidden;font-size:1.7rem;          font-weight:600">

                                <a href="{{ route('news-detail', $post->id) }}">{{ $post->title }}</a>
                            </div>
                            <div style="height: 150px;overflow:hidden">{!! $post->short_description !!}</div>
                            <div style="height: 120px;overflow:hidden" class="author">
                                <img src="{{ asset($post->user->avatar) }}" alt="">
                                <div class="author-info">
                                    <h5>{{ getFullName($post->user) }}</h5>
                                    <p>{{ $post->user->doctor->title }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
    <!-- Main container  -->
@endsection


@push('styles')
    <style>
        .news-list {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }

        .news-thumb {
            background: rgba(233, 232, 232, 0.638);
        }
    </style>
@endpush
