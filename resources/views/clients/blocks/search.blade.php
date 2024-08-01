<div class=" p-4" id="search" style="display: none">
    <div class="d-flex justify-content-around ">
        <a href="{{ route('homepage') }}" style="width: 12rem;">
            <img class="w-100" src="{{ asset('assets/imgs/logo (1).png') }}" alt="Logo">
        </a>
        <div class="row">
            <form method="get" action="{{ route('search') }}"
                class="d-flex justify-content-center align-items-center">
                <div class="form-outline" style="height: 30px;width:280px">
                    <input id="search-input" type="search" class="form-control" name="search_value"
                        placeholder="Search">
                </div>
                <button id="search-button" type="submit" class="btn btn-primary" style="height: 40px">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <div class="col-3 shadow bg-white rounded" id="searchList"
                style="position:fixed;transform:translateY(68px)">
            </div>
        </div>
        <div class="d-flex align-items-center" style="width: 100px;">
            <a href="" class="w-50"><i class="ti-search iConSearch"></i></a>
            <a href="{{ route('showCart') }}" class="w-50 text-center"><i class="ti-shopping-cart"></i></a>
            @if (Auth::check())
                <div class="w-50 text-center position-relative">
                    <a id="iconUser" href="#"><i class="ti-user"></i></a>
                    <ul id="userForm" class="list-unstyled position-absolute bg-white p-2 shadow"
                        style="display: none;">
                        <li><a href="#">Cập nhật thông tin</a></li>
                        <li>
                            <form action="{{ route('user.logout') }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit"
                                    style="border: none; background: none; padding: 0; cursor: pointer;">Đăng
                                    xuất</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('user.login') }}" class="w-50 text-center"><i class="ti-user"></i></a>
            @endif
        </div>
    </div>
</div>
