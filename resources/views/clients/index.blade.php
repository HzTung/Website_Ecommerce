@extends('clients.layouts.clientLayout')

@section('slider')
    <div class="swiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><img src="{{ asset('assets/imgs/slideshow_1.jpg') }}" alt=""></div>
            <div class="swiper-slide"><img src="{{ asset('assets/imgs/slideshow_2.jpg') }}" alt=""></div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
@endsection

@section('main')
    @include('clients.blocks.category')
    @include('clients.blocks.collection_heading')
    @include('clients.blocks.collection')
    @include('clients.blocks.element')
    @include('clients.blocks.parallax')
    @include('clients.blocks.collection')
    @include('clients.blocks.test')
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/sliderSwiper.js') }}"></script>
@endsection
