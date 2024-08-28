@extends('admin.layouts.adminlayout')

@section('main-content')
    <div class="container">
        <form action="{{ route('admin.user.store') }}" method="POST" class="row">
            @csrf
            <div class="col-6">
                <div class="form-group">
                    <label for="">Name</label>
                    <input class="form-control w-75" type="text" name="name">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input class="form-control w-75" type="email" name="email">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input class="form-control w-75" type="password" name="password">
                </div>
            </div>
            <div class="col-6">
                <h2>Roles</h2>

                @foreach ($roles as $role)
                    <div class="form-group">
                        <input type="checkbox" class="" name="role[]" value="{{ $role->id }}">
                        <label for="{{ $role->id }}">{{ $role->name }}</label>
                    </div>
                @endforeach
            </div>
            <button class="btn btn-primary">saves</button>
        </form>
    </div>
@endsection
