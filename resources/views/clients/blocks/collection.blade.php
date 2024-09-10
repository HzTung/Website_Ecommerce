<section>
    <div class="container-lg my-5">
        <div class="row">
            @foreach ($proAll as $k => $v)
                <div class="col-md-4 col-lg-4 col-6 col-xxl-3 ">
                    <div class="card p-sm-3">
                        <div class="image-container">
                            <div class="first">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="discount">-25%</span>
                                    <span class="wishlist"><i class="ti-heart"></i></span>
                                </div>
                            </div>
                            <img src="{{ asset('uploads/' . $v->img) }}" class="img-fluid rounded thumbnail-image">
                        </div>
                        <div class="product-detail-container p-2">
                            <div class="row">
                                <h5 class="font-bold fs-6 col-12">{{ $v->name_sp }}</h5>
                                <h1 class="old-price text-danger text-left col-12">{{ $v->price }} đ</h1>
                            </div>
                            <div class="d-flex justify-content-between align-items-center pt-1">
                                <div class="color-select d-flex">
                                    <input type="button" name="grey" class="btns black">
                                    <input type="button" name="red" class="btns yellow ml-2">
                                    <input type="button" name="blue" class="btns blue ml-2">
                                </div>
                                <div class="d-flex">
                                    <span class="item-size mr-2 btns" type="button">S</span>
                                    <span class="item-size mr-2 btns" type="button">M</span>
                                    <span class="item-size btns" type="button">L</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center pt-1">
                                <div>
                                    <i class="ti-star "></i>
                                    <span class="rating-number">4.8</span>
                                </div>
                                <a href="{{ route('proDetails', $v->id) }}" class="buy">BUY +</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
