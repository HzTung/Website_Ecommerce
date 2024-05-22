@extends('admin.layouts.adminlayout')

@section('content-header')
@endsection

@section('main-content')
    <div class="content">
        <div class="container-fluid">
        
            <div class="col-md-12">
                <table class="table table-striped text-center" >
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Mã Khách hàng</th>
                            <th scope="col">Mã Khách hàng</th>
                            <th scope="col">Ngày Mua</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($listBill as $bill => $row)
                            <tr>
                                <th scope='row'>{{ $bill + 1 }}</th>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->id_kh }}</td>
                                <td>{{ $row->ngaymua }}</td>
                                <td class="row d-flex justify-content-center">
                                    <a class='btn btn-info mr-2' href="{{ route('bills.show', ['bill' => $row->id]) }}">Xem</a>
                                    
                                    <form  action="{{ route('bills.destroy',$row->id) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button class='btn btn-danger' type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Delete</button>
                                      
                                    </form>
                                  
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
