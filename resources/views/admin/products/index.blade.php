@extends('admin.layouts.adminlayout')

@section('content-header')
@endsection

@section('main-content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @if (session('msg'))
                    <div class="col alert alert-success">{{ session('msg') }}</div>
                @endif
                <div class="col-md-12 ">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-success m-2 float-right">ADD</a>
                </div>
            </div>
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Mô tả</th>
                            <th scope="col">Ảnh</th>
                            <th scope="col">Danh Mục</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listProduct as $product => $row)
                            <tr>
                                <th scope='row'>{{ $product + 1 }}</th>
                                <td>{{ $row->name_sp }}</td>
                                <td>{{ $row->soluong }}</td>
                                <td>{{ $row->price }}</td>
                                <td>{{ $row->mota }}</td>
                                <td><img style="width:4rem;" src="{{ asset('uploads/' . $row->img) }}"></td>
                                <td>
                                    @if (isset($row->category_id))
                                        {{ $listCate->where('id', $row->category_id)->first()->name_category }}
                                    @else
                                        {{ 'NULL' }}
                                    @endif

                                    {{-- @if (isset($row->name_cate))
                                    {{$row->name_cate}}
                                @else
                                    {{'NULL'}}
                                @endif --}}
                                </td>

                                <td class="row">
                                    <a class='btn btn-default mr-2'
                                        href='{{ route('admin.products.edit', $row->id) }} '>Edit</a>
                                    {{-- <form  action="{{ route('products.destroy',$row->id) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button class='btn btn-danger' type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Delete</button>
                             
                                </form> --}}
                                    <a href="{{ route('admin.products.destroy', $row->id) }}" class="btn btn-danger"
                                        data-confirm-delete="true">Delete</a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                {{ $listProduct->links() }}
            </div>
        </div>
    </div>
@endsection
