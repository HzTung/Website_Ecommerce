<div id="formBuying" class=" " style="display: none;">
    <div class="d-flex justify-content-center align-items-center" style="height: 50vh;">
        <div class="d-flex justify-content-around">
            <a class="col-3" href="{{ route('bankPay') }}">
                <img class="w-50" src="{{ asset('assets/imgs/Banking-Segment-i2tutorials-768x665.jpg') }}"
                    alt="">
            </a>
            <form class="col-3" action="{{ route('momoPay') }}" method="post">
                @csrf
                <button type="submit" class="w-50">
                    <img class="w-100" src="{{ asset('assets/imgs/OIP.jpg') }}" alt="">
                </button>
            </form>
        </div>
    </div>
</div>
