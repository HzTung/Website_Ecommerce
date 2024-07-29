<div class="breadcrumb">
    <ul class="container">
        <li class="text-top">
            <a href="{{route('homepage')}}">Trang Chủ</a> / {{$name}}
        </li>
        <li class="text-main">{{$name}}</li>
        <li class="text-bottom">
            Danh Mục
            <i class="ti-angle-down"></i>
            <ul class="breadcrumb-list">
                <li><a href="{{route('product')}}">Tất cả sản phẩm</a></li>
                @foreach ($CateAll as $item)
                <li><a href="{{route('product',$item->id)}}">{{$item->name_category}}</a></li>
                @endforeach
            </ul>
        </li>
    </ul>
</div>