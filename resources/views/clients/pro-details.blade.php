@extends('clients.layouts.clientLayout')
@section('slider')
@endsection

@section('main')
    <div class="product-details mt-5">
        <div class="container-md">
            <div class="text-heading">
                <a href="{{ route('homepage') }}">Trang Chủ</a> /
                <a href="{{ route('product') }}">Sản phẩm</a> /
                {{ $product->name_sp }}
            </div>
            <div class="d-flex flex-column flex-md-row justify-content-center ">
                <!-- Product Image -->
                <div class="col-12 col-md-6 text-center text-md-start">
                    <img class="w-75" src="{{ asset('uploads/' . $product->img) }}" alt="">
                </div>

                <!-- Product Details -->
                <div class="col-12 col-md-6 mt-4 mt-md-0">
                    <div>
                        <p class="name-product">{{ $product->name_sp }}</p>
                        <div class="price-product fs-5">
                            {{ $product->price }} đ
                        </div>
                        <span class="d-block mt-3" style="font-size: 14px">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed laudantium eveniet expedita debitis
                            amet. Molestiae, placeat eligendi itaque voluptatibus nihil unde. Necessitatibus beatae natus
                            aperiam ullam explicabo iure doloribus et.
                        </span>

                        <!-- Color Selection -->
                        <div class="color-select d-flex mt-4">
                            <input type="button" name="grey" class="btns black">
                            <input type="button" name="red" class="btns yellow ms-2">
                            <input type="button" name="blue" class="btns blue ms-2">
                        </div>

                        <!-- Size Selection -->
                        <div class="d-flex my-4">
                            <input type="button" name="grey" class="bg-white border border-1 me-2" value="XS"
                                style="height: 25px; width: 25px">
                            <input type="button" name="red" class="bg-white border border-1 me-2" value="S"
                                style="height: 25px; width: 25px">
                            <input type="button" name="blue" class="bg-white border border-1 me-2" value="M"
                                style="height: 25px; width: 25px">
                            <input type="button" name="red" class="bg-white border border-1 me-2" value="L"
                                style="height: 25px; width: 25px">
                            <input type="button" name="blue" class="bg-white border border-1" value="XL"
                                style="height: 25px; width: 25px">
                        </div>

                        <!-- Add to Cart Form -->
                        <form action="{{ route('addCart', $product->id) }}" method="post">
                            @csrf
                            <div class="variant-sizguide d-flex justify-content-start">
                                <div class="size-product me-3">
                                    <label for="">Kích Thước</label>
                                    <select class="select-size form-select" name="size">
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                    </select>
                                </div>
                                <div class="quantity-product">
                                    <label for="">Số Lượng</label>
                                    <select name="soluong" class="form-select">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-buy mt-4 w-100" type="submit" name="add-product">Thêm Vào
                                Giỏ</button>
                        </form>
                    </div>
                    <hr>
                    <!-- Product Description -->
                    <div class="d-flex flex-column my-4">
                        <b class="fs-5 mt-5">Description</b>
                        <span class="fw-medium mt-3 opacity-75">About the product</span>
                        <span class="mt-3 opacity-75">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum
                            placeat laboriosam cumque dolor iste ea quasi deleniti sapiente earum minima iure eligendi unde
                            similique, accusantium voluptate nostrum tempore quam amet!</span>
                        <div class="mt-3 opacity-75">
                            <i class="ti-check-box"></i>
                            <span>100% Cotton</span>
                        </div>
                        <div class="mt-1 opacity-75">
                            <i class="ti-check-box"></i>
                            <span>260gsm</span>
                        </div>
                        <div class="mt-1 opacity-75">
                            <i class="ti-check-box"></i>
                            <span>Breathable Fabric</span>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <br>
            @include('clients.blocks.comment')
            <hr>
            <br>
            <h4 class="p-2">Sản phẩm liên quan</h4>
            <div #swiperRef="" class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach ($proAll as $k => $v)
                        <a href="{{ route('proDetails', $v->id) }}" class="swiper-slide row">
                            <div class="">
                                <img src="{{ asset('uploads/' . $v->img) }}" alt="">
                            </div>
                            <div class="">
                                <p>{{ $v->name_sp }}</p>
                                <p style="
                                color: #ff00009e;">{{ $v->price }} đ</p>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="module">
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 6,
            spaceBetween: 30,
            pagination: {
                el: ".swiper-pagination",
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
@endsection
