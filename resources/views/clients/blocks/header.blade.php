<div id="header">
    <div class="container-nav">
        <div class="container-fluid row">
            <div class="d-flex justify-content-between align-items-center p-3 mb-4">
                <div class="">
                    <img src=" {{asset('assets/imgs/flag-vie2.png')}}" alt="" >
                    <img src=" {{asset('assets/imgs/flag-en2.png')}}" alt="" >
                </div>
                <div style="width:12rem" >
                    <img class="w-100" src="{{asset('assets/imgs/logo (1).png')}}" alt="">
                </div>
                <div class="d-flex justify-content-around" style="width:100px">
                    <a href="" class="w-50"><i class="ti-search " ></i></a> 
                    <a href="{{route('showCart')}}" class="w-50"><i class="ti-shopping-cart"></i></a>
                    <a href="{{route('user.login')}}" class="w-50"><i class="ti-user"></i></a> 

                </div>
            </div>
            <div class="d-flex justify-content-center navbar navbar-expand">
                <ul class="d-flex justify-content-around w-75">
                    <li><a href="{{route('homepage')}}">Trang chủ</a></li>
                    <li><a href="">Về chúng tôi</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="{{route('product')}}"  data-toggle="dropdown" data-bs-toggle="dropdown" >
                            Cửa hàng
                          </a>
                        <ul class="dropdown-menu">
                            @foreach ($CateAll as $k => $v)
                            <li class=""> <a class="dropdown-item d-flex justify-content-between" href="{{route('product',$v->id)}}">{{$v->name_category}}
                                <i class="ti-angle-right"></i></a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="">Bộ Sưu Tập</a></li>
                    <li><a href="">Bộ phối</a></li>
                    <li><a href="">Bài viết</a></li>
                    <li><a href="">Chăm sóc khách hàng</a></li>
                    <li><a href="">Tuyển dụng</a></li>
                    <li><a href="">Liên hệ</a></li>
                </ul>
            </div>
        </div>
      
    </div>
</div>