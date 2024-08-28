@extends('admin.layouts.adminlayout')

@section('main-content')
    <div class="container">
        <form action="{{ route('admin.user.update', $user->id) }}" method="POST" class="row">
            @csrf
            @method('PUT')
            <div class="col-6">
                <div class="form-group">
                    <label for="">Name</label>
                    <input class="form-control w-75" type="text" name="name" value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input class="form-control w-75" type="email" name="email" value="{{ $user->email }}">
                </div>
            </div>
            <div class="col-6">
                <h2>Roles</h2>

                @foreach ($roles as $role)
                    <div class="form-group">
                        <input type="checkbox" class="" @if (in_array($role->id, $roleChecked)) checked @endif
                            name="role[]" value="{{ $role->id }}" id="{{ $role->id }}">
                        <label for="{{ $role->id }}">{{ $role->name }}</label>
                    </div>
                @endforeach
            </div>
            <button class="btn btn-primary">saves</button>
        </form>
    </div>
@endsection
