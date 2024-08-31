<div class="p-4" id="search" style="display: none">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
        <!-- Logo -->
        <a href="{{ route('homepage') }}" class="mb-3 mb-md-0" style="width: 12rem;">
            <img class="w-100" src="{{ asset('assets/imgs/logo.png') }}" alt="Logo">
        </a>

        <!-- Search Form -->
        <div class="w-100 w-md-auto mb-3 mb-md-0 py-4">
            <form method="get" action="{{ route('search') }}"
                class="d-flex justify-content-center align-items-center">
                <div class="form-outline me-2" style="height: 30px;width:100%; max-width: 280px;">
                    <input id="search-input" type="search" class="form-control" name="search_value"
                        placeholder="Search">
                </div>
                <button id="search-button" type="submit" class="btn btn-primary" style="height: 40px">
                    <i class="ti-search"></i>
                </button>
            </form>
            <div class="col-md-6 col-lg-6 col-xxl-3 col-xl-3 shadow bg-white rounded mx-auto start-0 end-0 "
                id="searchList" style="position:fixed;transform:translateY(68px); display: none;">
            </div>
        </div>

        <!-- User and Cart Icons -->
        <div class="d-flex align-items-center justify-content-center">
            <a href="" class="d-flex align-items-center justify-content-center me-3"><i
                    class="ti-search iConSearch"></i></a>
            <a href="{{ route('showCart') }}" class="d-flex align-items-center justify-content-center me-3"><i
                    class="ti-shopping-cart"></i></a>
            @if (Auth::check())
                <div class="position-relative">
                    <a id="iconUser" href="#" class="d-flex align-items-center justify-content-center"><i
                            class="ti-user"></i></a>
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
                <a href="{{ route('user.login') }}" class="d-flex align-items-center justify-content-center"><i
                        class="ti-user"></i></a>
            @endif
        </div>
    </div>
</div>
