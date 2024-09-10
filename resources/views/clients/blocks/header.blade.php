<div id="header">
    <div class="container-nav">
        <div class="container-fluid row ">
            <div class="d-flex justify-content-between align-items-center p-3 mb-4">
                <div class="">
                    <img src=" {{ asset('assets/imgs/flag-vie2.png') }}" alt="">
                    <img src=" {{ asset('assets/imgs/flag-en2.png') }}" alt="">
                </div>
                <div style="width:12rem">
                    <a href="{{ route('homepage') }}" class="w-100"><img class="w-100"
                            src="{{ asset('assets/imgs/logo.png') }}" alt=""></a>
                </div>
                <div class="d-flex justify-content-around" style="width:100px">
                    <a href="" id="iConSearch" class="w-50"><i class="ti-search iConSearch"></i></a>
                    <a href="{{ route('showCart') }}" class="w-50"><i class="ti-shopping-cart"></i></a>
                    @if (Auth::check())
                        <a id="iconUser" href="#" class="w-50"><i class="ti-user"></i></a>
                        <ul id="userForm" style="display: none; position: absolute; transition: transform 0.3s ease;">
                            <li><a href="{{ route('user.profile') }}">Cập nhật thông tin </a></li>
                            <i>
                                <form action="{{ route('user.logout') }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" style="border: unset">Đăng xuất</button>
                                </form>
                            </i>
                        </ul>
                    @else
                        <a href="{{ route('user.login') }}" class="w-50"><i class="ti-user"></i></a>
                    @endif
                </div>
            </div>
            <div class="d-flex justify-content-center navbar navbar-expand">
                <ul class="d-flex justify-content-around w-75">
                    <li><a href="{{ route('homepage') }}">Trang chủ</a></li>
                    <li><a href="">Về chúng tôi</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="{{ route('product') }}" data-toggle="dropdown"
                            data-bs-toggle="dropdown">
                            Cửa hàng
                        </a>
                        <ul class="dropdown-menu">
                            @foreach ($CateAll as $k => $v)
                                <li class=""> <a class="dropdown-item d-flex justify-content-between"
                                        href="{{ route('product', $v->id) }}">{{ $v->name_category }}
                                        <i class="ti-angle-right"></i></a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="" class="">Bộ Sưu Tập</a></li>
                    <li><a href="">Bộ phối</a></li>
                    <li><a href="">Bài viết</a></li>
                    <li><a href="" class="d-none d-xl-block">Chăm sóc khách hàng</a></li>
                    <li><a href="" class="">Tuyển dụng</a></li>
                    <li><a href="" class="d-none d-xl-block">Liên hệ</a></li>
                </ul>
            </div>
        </div>
    </div>
    {{--  --}}
    <div class="tablet d-none container-lg py-3">
        <div class="d-flex justify-content-between align-items-center">
            <div class="w-50">
                <a class="w-50" href="{{ route('homepage') }}"> <img class="w-100 img-fluid"
                        src="{{ asset('assets/imgs/logo.png') }}" alt=""></a>
            </div>
            <div class="d-flex justify-content-around ">
                <a href="" id="iConSearch" class="w-50 px-2"><i class="ti-search iConSearch"></i></a>
                <a href="{{ route('showCart') }}" class="w-50 px-2"><i class="ti-shopping-cart"></i></a>
                @if (Auth::check())
                    <a id="iconUser" href="#" class="w-50 px-2"><i class="ti-user"></i></a>
                    <ul id="userForm" style="display: none; position: absolute; transition: transform 0.3s ease;">
                        <li><a href="{{ route('user.profile') }}">Cập nhật thông tin </a></li>
                        <i>
                            <form action="{{ route('user.logout') }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" style="border: unset">Đăng xuất</button>
                            </form>
                        </i>
                    </ul>
                @else
                    <a href="{{ route('user.login') }}" class="w-50 px-2"><i class="ti-user"></i></a>
                @endif
                <div class="iconMenu px-2 p-1">
                    <i class="ti-menu   "></i>
                </div>
            </div>
        </div>
    </div>

    {{--  --}}

    <div class="d-none position-fixed w-100 h-100 z-3 top-0 bg-white menu_toggle">
        <div class="row ">
            <div class="col-12 d-flex justify-content-between p-3 align-items-center">
                <a href="{{ route('homepage') }}"> <img src="{{ asset('assets/imgs/logo.png') }}" alt=""></a>
                <i class="ti-close iconClose p-3"></i>
            </div>
            <div class="col-12">
                <ul class="list-group">
                    <li class="list-group-item"><a href="{{ route('homepage') }}">Trang chủ</a></li>
                    <li class="list-group-item"><a href="">Về chúng tôi</a></li class="list-group-item">
                    <li class="dropdown list-group-item">
                        <a class="dropdown-toggle" href="{{ route('product') }}" data-toggle="dropdown"
                            data-bs-toggle="dropdown">
                            Cửa hàng
                        </a>
                        <ul class="dropdown-menu w-100">
                            @foreach ($CateAll as $k => $v)
                                <li class=" w-100"> <a class="dropdown-item d-flex justify-content-between"
                                        href="{{ route('product', $v->id) }}">{{ $v->name_category }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="list-group-item"><a href="" class="">Bộ Sưu Tập</a></li>
                    <li class="list-group-item"><a href="">Bộ phối</a></li>
                    <li class="list-group-item"><a href="">Bài viết</a></li>
                    <li class="list-group-item"><a href="" class="">Chăm sóc khách hàng</a></li>
                    <li class="list-group-item"><a href="" class="">Tuyển dụng</a></li>
                    <li class="list-group-item"><a href="" class="">Liên hệ</a></li>
                </ul>
            </div>
        </div>
    </div>


</div>
