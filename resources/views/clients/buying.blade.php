@extends('clients.layouts.clientLayout')

@section('main')
    <section class="h-100 h-custom" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card">
                        <div class="card-body p-4">
                            {{-- @csrf --}}
                            <div class="row">
                                <div class="col-lg-7">
                                    <h5 class="mb-3"><a href="{{ 'product' }}" class="text-body"><i
                                                class="fas fa-long-arrow-alt-left me-2"></i>Tiếp tục mua hàng</a></h5>
                                    <hr>
                                    <!--  -->
                                    @foreach (session()->get('cart') as $item)
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div class="d-flex flex-row align-items-center">
                                                        <div>
                                                            <img src="{{ asset('uploads/' . $item['img']) }}"
                                                                class="img-fluid rounded-3" alt="Shopping item"
                                                                style="width: 65px;">
                                                        </div>
                                                        <div class="ms-3">
                                                            <h7>{{ $item['name'] }}</h7>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-row align-items-center">
                                                        <div class="d-flex flex-row align-items-center">
                                                            <div style="width: 50px;">
                                                                <h5 class="fw-normal mb-0">{{ $item['size'] }}</h5>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-row align-items-center">
                                                            <div style="width: 50px;">
                                                                <h5 class="fw-normal mb-0">{{ $item['quantity'] }}</h5>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-row align-items-center">
                                                            <div style="width: 100px;">
                                                                <h5 class="mb-0">{{ $item['price'] }}</h5>
                                                            </div>
                                                            <a href="{{ route('delCart', $item['id']) }}"
                                                                style="color: #cecece;"><i class="ti-trash"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <!--  -->
                                </div>
                                <!--  -->

                                <div class="col-lg-5">
                                    <div class="card bg-primary text-white rounded-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                <h5 class="mb-0">Giỏ hàng</h5>
                                            </div>
                                            <hr class="my-4">
                                            <div class="d-flex justify-content-between mb-4">
                                                <p class="mb-2">Tổng tiền:</p>
                                                <p class="mb-2">{{ $totalPrice }} đ</p>
                                            </div>
                                            <div>
                                                <button id="btn-buying" type="submit"
                                                    class="btn btn-info btn-block btn-lg text-center">
                                                    <div class="d-flex justify-content-between">
                                                        <span>Đặt Hàng </span>
                                                        <i class="ti-shift-right"></i>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('clients.blocks.form-buying')
@endsection
