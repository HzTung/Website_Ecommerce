<div id="collection">
    <div class="container">

        <div class="collection-content">
            <div class="collection-content_container">

                @foreach ($proAll as $k => $v)
                    <a href="{{ route('proDetails', $v->id) }}" class="collection-content_item">
                        <div class="collection-item_img">
                            <img src="{{ asset('uploads/' . $v->img) }}" alt="">
                        </div>
                        <div class="collection-item_text">
                            <p>{{ $v->name_sp }}</p>
                            <p style="font-weight: 600;
                            color: #ff00009e;">
                                {{ $v->price }} đ</p>
                        </div>
                    </a>
                @endforeach
            </div>
            {{-- <div class="collection-content_btn">
                <a href="./view/product/sanpham.php" class="xemthem">Xem Thêm
                    <i class="ti-angle-down"></i>
                </a>
            </div> --}}
        </div>
    </div>
</div>

<div class=" container d-flex justify-content-stard">
    {{ $proAll->appends(['search_value' => request()->input('search_value')])->links() }}
</div>
