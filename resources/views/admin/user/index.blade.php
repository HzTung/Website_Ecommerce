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
                    <a href="{{ route('employees.create') }}" class="btn btn-success m-2 float-right">ADD</a>
                </div>
            </div>
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên nhân viên</th>
                            <th scope="col">Email</th>
                            <th scope="col">Create At</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user => $item)
                            <tr>
                                <td scope="col">{{ $loop->iteration }}</td>
                                <td scope="col">{{ $item->name }}</td>
                                <td scope="col">{{ $item->email }}</td>
                                <td scope="col">{{ $item->updated_at }}</td>
                                <td class="row">
                                    <a href="" class="btn btn-default mx-2">Edit</a>
                                    <form action="{{ route('admin.destroy', $item->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
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
