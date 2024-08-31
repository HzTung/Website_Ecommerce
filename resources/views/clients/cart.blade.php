@extends('clients.layouts.clientLayout')

@section('main')
    <div class="container mt-5">
        @if (session()->has('cart') && count(session('cart')) > 0)
            <table class="table ">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col-2">Tên sản phẩm</th>
                        <th class="col-3">Hình ảnh </th>
                        <th scope="col-1">size</th>
                        <th scope="col-1">Số lượng</th>
                        <th scope="col-1">Số Tiền</th>
                        <th scope="col-1">Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (session()->get('cart') as $cart => $item)
                        <tr class="">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td><img class="w-25" src="{{ asset('uploads/' . $item['img']) }}" alt=""></td>
                            <td>{{ $item['size'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ $item['price'] }}</td>
                            <td> <a href="{{ route('delCart', $item['id']) }}" style="color: #cecece;"><i
                                        class="ti-trash"></i></a></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="clearfix">
                <form action="{{ route('momoPay') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary float-right">Thanh Toán</button>
                </form>

            </div>
        @else
            <h3 class="d-flex justify-content-center align-items-center mt-3">Không có giỏ hàng</h3>
        @endif
    </div>
@endsection
