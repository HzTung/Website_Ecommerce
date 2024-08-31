@extends('clients.layouts.clientLayout')

@section('slider')
    <div class="swiper d-none d-md-block">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><img src="{{ asset('assets/imgs/slideshow_1.jpg') }}" alt=""></div>
            <div class="swiper-slide"><img src="{{ asset('assets/imgs/slideshow_2.jpg') }}" alt=""></div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <div>
        <img class="d-block d-md-none img-fluid" src="{{ asset('assets/imgs/slideshowmobile.jpg') }}" alt="">
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
