@extends('admin.layouts.adminlayout')

@section('content-header')
@endsection

@section('main-content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 ">
                    <a href="{{ route('addCate') }}" class="btn btn-success m-2 float-right">ADD</a>
                </div>
            </div>
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Mota</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category => $row)
                            <tr>
                                <th scope='row'>{{ $category + 1 }}</th>
                                <td>{{ $row->name_category }}</td>
                                <td>{{ $row->mota }}</td>
                                <td class="row">
                                    <a class='btn btn-default mr-2' href="{{ route('editCate', ['category' => $row->id]) }}">Edit</a>
                                    
                                    {{-- <form  action="{{ route('deleteCate',$row->id) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button class='btn btn-danger' type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Delete</button>
                                        <button class='btn btn-danger' type="submit" data-confirm-delete="true">Delete</button>
                                    </form> --}}
                                    <a href="{{ route('deleteCate', $row->id) }}" class="btn btn-danger" data-confirm-delete="true">Delete</a>

                                  
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
