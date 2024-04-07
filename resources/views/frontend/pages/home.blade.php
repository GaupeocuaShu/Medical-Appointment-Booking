@extends('frontend.layout.master')
@section('content')
    {{-- Home  --}}
    @include('frontend.section.home')
    {{-- About --}}
    @include('frontend.section.about')
    {{-- About --}}
    @include('frontend.section.team')
    {{-- News --}}
    @include('frontend.section.news')

    {{-- Map --}}
    @include('frontend.section.map')
@endsection
