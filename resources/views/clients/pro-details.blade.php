@extends('clients.layouts.clientLayout')
@section('slider')
    
@endsection

@section('main')

    <div class="product-details">
        <div class="container">
            <div class="text-heading">
                <a href="{{route('homepage')}}">Trang Chủ</a> /
                <a href="{{route('product')}}">Products</a> /
                {{$product->name_sp}}
            </div>
            <div class="product-main">
                <img src="{{asset('uploads/'.$product->img)}}" alt="">
                <div class="product-content">
                    <p class="name-product">{{$product->name_sp}}</p>
                    <div class="price-product">
                       {{$product->price}} đ
                    </div>

                    <form action="{{route('addCart',$product->id)}}" method="post">
                        @csrf
                        <div class="variant-sizguide">
                            <div class="size-product">
                                <label for="">Kích Thước</label>
                                <select class="select-size" name="size">
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">Xl</option>
                                </select>
                            </div>
                            <div class="quantity-product">
                                <label for="">Số Lượng</label>
                                <select name="soluong" id="">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                        </div>

                        <button class="btn-buy" type="submit" name="add-product">Thêm Vào Giỏ</button>
                    </form>

                </div>
            </div>
            <hr>
            <br>
            @include('clients.blocks.comment')
        </div>
    </div>
@endsection