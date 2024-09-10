<?php

namespace App\Http\Controllers\clients;

use App\Models\Bills;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BillsDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection;

class CartController extends Controller
{
    public function index()
    {
        $getCate = Category::get();
        if (session()->has('cart')) {
            $totalPrice = 0;
            foreach (session()->get('cart') as $item) {
                $totalPrice += $item['price'] * $item['quantity'];
            }
        }
        return view(
            'clients.buying',
            [
                'CateAll' => $getCate,
                'totalPrice' => $totalPrice
            ]
        );
    }

    function addToCart(Request $request, $id)
    {
        $cart = $request->session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->input('soluong');
        } else {
            try {
                $product = Products::find($id);
            } catch (\Throwable $th) {
                //throw $th;
            }
            $cart[$id] = [
                'id' => $id,
                'name' => $product->name_sp,
                'price' => $product->price,
                'quantity' => $request->input('soluong'),
                'size' => $request->input('size'),
                'img' => $product->img
            ];
        }
        $request->session()->put('cart', $cart);

        return redirect()->route('cart');
    }

    function delToCart(Request $request, $id)
    {
        $cart = $request->session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            $request->session()->put('cart', $cart);
        }
        return back();
    }

    function createQR_CODE()
    {
        if (session()->has('cart')) {
            $totalPrice = 0;
            foreach (session()->get('cart') as $item) {
                $totalPrice += $item['price'] * $item['quantity'];
            }
        }
        return view('clients.createQR_code', [
            'amount' => $totalPrice,
        ]);
    }

    function buySubmit()
    {
        if (session()->has('cart')) {
            // Kiểm tra xem giỏ hàng có mục nào không
            if (count(session()->get('cart')) > 0) {
                $id_user = Auth::check() ? Auth::user()->id : null;
                $newBill = Bills::create([
                    'id_kh' => $id_user,
                    'ngaymua' => now(),
                ]);

                if ($newBill) {
                    foreach (session()->get('cart') as $item) {
                        BillsDetail::create([
                            'id_bill' => $newBill->id,
                            'id_sp' => $item['id'],
                            'dongia' => $item['price'] * $item['quantity'],
                            'size' => $item['size'],
                            'soluong' => $item['quantity']
                        ]);
                    }
                    session()->forget('cart');
                    return redirect()->route('homepage')->with('success', 'Đã đặt hàng thành công.');
                } else {
                    return redirect()->back()->with('error', 'Đã xảy ra lỗi khi đặt hàng.');
                }
            } else {
                return redirect()->route('cart')->with('error', 'Giỏ hàng của bạn đang trống.');
            }
        } else {
            return redirect()->route('cart')->with('error', 'Giỏ hàng của bạn đang trống.');
        }
    }


    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function momo_payment(Request $request)
    {
        $cart = session()->get('cart');
        $cart = array_values($cart);
        $totalPrice = 0;
        for ($i = 0; $i < count($cart); $i++) {
            $totalPrice += $cart[$i]['price'] * $cart[$i]['quantity'];
        }

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

        // Properly encoding non-ASCII characters
        $orderInfo = "Thanh toán qua MoMo";

        // Ensure URLs are properly URL-encoded
        $redirectUrl = "http://127.0.0.1:8000/buy";
        $ipnUrl = "http://127.0.0.1:8000/buy";

        $amount = $totalPrice;
        $orderId = time() . "";
        $extraData = "";

        $requestId = time() . "";
        $requestType = "payWithATM";

        // Construct raw hash with properly encoded values
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;

        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => urldecode($redirectUrl), // Decode back for actual request
            'ipnUrl' => urldecode($ipnUrl), // Decode back for actual request
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );

        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);

        return redirect()->to($jsonResult['payUrl']);
    }


    function cart()
    {
        // $id_kh = Auth::user()->id;
        // $bill = new Bills();
        // $getbill = $bill->billjoin($id_kh);
        // $getbill = collect($getbill)->groupBy('id_bill')->toArray();
        // $getbill = array_values($getbill);
        $getCate = Category::get();
        return view('clients.cart', [
            'CateAll' => $getCate,
            // 'BillAll' => $getbill
        ]);
    }
}
