@extends('admin.layouts.adminlayout')

@section('content-header')
@endsection

@section('main-content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('admin.category.update', $id) }}">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name Category</label>
                            <input type="text" name="name" class="form-control w-25" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="" value="{{ $cateById->name_category }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <input type="text" name="mota" id="" class="form-control w-25"
                                value="{{ $cateById->mota }}"></input>
                            @error('mota')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
