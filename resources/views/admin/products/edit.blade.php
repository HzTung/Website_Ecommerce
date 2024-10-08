@extends('admin.layouts.adminlayout')

@section('content-header')
@endsection

@section('main-content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('admin.products.update', $id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                            <input type="text" name="name_sp" class="form-control w-25" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="" value="{{ $ProById->name_sp }}">
                            @error('name_sp')
                                <span style="color:red">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Số Lượng</label>
                            <input type="text" name="soluong" class="form-control w-25" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="" value="{{ $ProById->soluong }}">
                            @error('soluong')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Giá</label>

                            <input type="text" name="price" class="form-control w-25" id=""
                                aria-describedby="emailHelp" placeholder="" value="{{ $ProById->price }}">
                            @error('price')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô Tả</label>
                            <input type="text" name="mota" class="form-control w-25" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="" value="{{ $ProById->mota }}">
                            @error('mota')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hình Ảnh</label>
                            <img id="imgEdit" src="{{ asset('uploads/' . $ProById->img) }}" alt=""
                                style="width:10rem ; display:block">
                            <input type="file" name="img" class="form-control w-25" id="editImgInput"
                                accept="{{ $ProById->img }}" style="display:inline-block">
                            <span id="fileName">{{ $ProById->img }}</span>
                            @error('img')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group ">
                            <label for="exampleInputPassword1">Danh Mục</label>
                            <select class="form-select px-4 py-1 " aria-label="Default select example" name="category_id">
                                <option selected
                                    value="
                            @if (isset($ProById->category_id)) {{ $ProById->category_id }}
                            @else
                            {{ '' }} @endif
                            ">
                                    @if (isset($cateById->name_category))
                                        {{ $cateById->name_category }}
                                    @else
                                        {{ 'NULL' }}
                                    @endif
                                </option>
                                @foreach ($cateAll as $item)
                                    <option value="{{ $item->id }}">{{ $item->name_category }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-danger">Canel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
