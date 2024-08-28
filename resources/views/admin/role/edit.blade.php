@extends('admin.layouts.adminLayout')

@section('main-content')
    <div class="container">
        <h3>Danh sách nhóm quyền</h3>
        <form action="{{ route('admin.role.update', $role->id) }}" method="POST">
            @method('PUT')
            @csrf
            <p for="">Tên nhóm quyền</p>
            <input type="text" class="" name="name" value="{{ $role->name }}">

            <div class="row">
                @foreach ($routes as $route)
                    <div class="form-check col-3">
                        <input class="form-check-input" name="checkbox[]" type="checkbox"
                            @if (in_array($route, json_decode($role->permission))) checked @endif value="{{ $route }}"
                            id="{{ $route }}">
                        <label class="form-check-label" for="{{ $route }}">
                            {{ $route }}
                        </label>
                    </div>
                @endforeach
            </div>
            <button type="submit " class="btn btn-primary">Save</button>
            <div class="form-check col-3">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Check All
                </label>
            </div>
        </form>
    </div>
@endsection
