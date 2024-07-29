@extends('clients.layouts.clientLayout')


@section('main')
    @include('clients.blocks.breadcrumb')
    <div class="container ">
        <h5 class="ml-5 mt-4">Kết quả tìm kiếm "{{ strtoupper($search) }}":</h5>
    </div>
    @include('clients.blocks.collection')
@endsection
