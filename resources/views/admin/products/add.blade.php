@extends('admin.layouts.adminlayout')

@section('content-header')
@endsection

@section('main-content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                            <input type="text" name="name_sp" class="form-control w-25" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="" value="{{ old('name_sp') }}">
                            @error('name_sp')
                                <span style="color:red">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Số Lượng</label>
                            <input type="text" name="quantity" class="form-control w-25" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="" value="{{ old('quantity') }}">
                            @error('quantity')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Giá</label>
                            <input type="text" name="price" class="form-control w-25" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="" value="{{ old('price') }}">
                            @error('price')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô Tả</label>
                            <input type="text" name="mota" class="form-control w-25" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="" value="{{ old('mota') }}">
                            @error('mota')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hình Ảnh</label>
                            <img id="imgEdit" src="" alt="" style="width:10rem ; display:block">
                            <input type="file" name="img" class="form-control w-25" id="editImgInput"
                                style="display:inline-block">
                            <span id="fileName"></span>
                            @error('img')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group ">
                            <label for="exampleInputPassword1">Danh Mục</label>
                            <select class="form-select " aria-label="Default select example" name="cate">
                                <option selected value="{{ old('cate') }}">Open this select menu</option>
                                @foreach ($cateAll as $item)
                                    <option value="{{ $item->id }}">{{ $item->name_category }}</option>
                                @endforeach
                            </select>
                            @error('cate')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('homeProduct') }}" class="btn btn-danger">Canel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
