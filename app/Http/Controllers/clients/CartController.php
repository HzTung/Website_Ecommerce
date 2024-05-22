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
            $product = Products::find($id);
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
            $totalPrice += $cart[$i]['price'];
        }
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $totalPrice;
        $orderId = time() . "";
        $redirectUrl = "http://127.0.0.1:8000/buy";
        $ipnUrl = "http://127.0.0.1:8000/buy";
        $extraData = "";


        // $partnerCode = $_POST["partnerCode"];
        // $accessKey = $_POST["accessKey"];
        // $secretKey = $_POST["secretKey"];
        // $orderId = $_POST["orderId"]; // Mã đơn hàng
        // $orderInfo = $_POST["orderInfo"];
        // $amount = $_POST["amount"];
        // $ipnUrl = $_POST["ipnUrl"];
        // $redirectUrl = $_POST["redirectUrl"];
        // $extraData = $_POST["extraData"];

        $requestId = time() . "";
        $requestType = "payWithATM";
        // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
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
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = $this->execPostRequest($endpoint, json_encode($data));

        $jsonResult = json_decode($result, true);  // decode json

        //Just a example, please check more in there


        return redirect()->to($jsonResult['payUrl']);
        // header('Location: ' . $jsonResult['payUrl']);
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
