@extends('clients.layouts.clientLayout')

@section('main')
    <div class="container">
       
        <table class="table" >
            <thead class="thead-light">
              <tr>
                <th scope="col">#</th>
                <th scope="col-2">Sản phẩm</th>
                <th class="col-3"> </th>
                <th scope="col-1">Đơn giá</th>
                <th scope="col-1">Số lượng</th>
                <th scope="col-1">Số Tiền</th>
                <th scope="col-1">Trạng Thái</th>
                <th scope="col-1">Thao Tác</th>
              </tr>
            </thead>
            <tbody>
            @php
              $billCount = count($BillAll);
            @endphp
              @for ($i = 0; $i < $billCount; ++$i)
                @foreach ($BillAll[$i] as $bill => $item)
                @php
                    $rowCount = count($BillAll[$i]);
                @endphp
                <tr class="border border-primary">
                  @if ($loop->first)
                  <th rowspan="{{$rowCount}}" scope="row" class="">{{$i + 1}}</th>
                  @endif
                    <td>{{$item->name_sp}}</td>
                    <td><img class="w-25" src="{{asset('uploads/'. $item->img)}}" alt=""></td>
                    <td>{{$item->price}}</td>
                    <td>{{$item->soluong}}</td>
                    <td>{{$item->dongia}}</td>
                    @if ($loop->first)
                      <td rowspan="{{$rowCount}}" >@if ($item->trangthai_dh == '1')
                        <p>Chưa thanh Toán</p>
                          @else
                        <p>Đã thanh toán</p>
                      @endif</td>
                    <td>Otto</td>
                    @else
                        
                    @endif
                </tr>
                @endforeach
                @endfor
              
            </tbody>
          </table>
    </div>
@endsection