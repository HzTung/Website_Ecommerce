@extends('admin.layouts.adminlayout')

@section('content-header')
@endsection

@section('main-content')
    <div class="content">
        <div class="container-fluid">
        
            <div class="col-md-12">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Mã đơn hàng</th>
                            <th scope="col">Mã sản phẩm</th>
                            <th scope="col">Đơn giá</th>
                            <th scope="col">Tình trạng sản phẩm</th>
                            <th scope="col">Size</th>
                            <th scope="col">Số lượng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($listBill as $bill => $row)
                            <tr>
                                <th scope='row'>{{ $bill + 1 }}</th>
                                <td>{{ $row->id_bill }}</td>
                                <td>{{ $row->id_sp }}</td>
                                <td>{{ $row->dongia }}</td>
                                <td>{{ $row->tinhtrang_sp }}</td>
                                <td>{{ $row->size }}</td>
                                <td>{{ $row->soluong }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
