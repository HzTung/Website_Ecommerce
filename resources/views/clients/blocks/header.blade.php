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
    <div class="tablet d-none container-lg">
        <div class="d-flex justify-content-between align-items-center">
            <div class="">
                <a href="{{ route('homepage') }}"> <img class="" src="{{ asset('assets/imgs/logo.png') }}"
                        alt=""></a>
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
                <i class="ti-menu px-2"></i>
            </div>
        </div>
    </div>

    <div class="menu">

    </div>
</div>
