<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use App\Models\Cart;

class StripeController extends Controller
{
    public function checkout()
    {
        $cart=Cart::where('user_id',auth()->user()->id)->get();
        return view('stripe.checkout',['data'=>$cart]);
        // return view('stripe.checkout');
    }

    public function session(Request $request)
    {
        // dd($request);
        \Stripe\Stripe::setApiKey(config('stripe.sk'));
 
        $productname = 'amount mony will take from your card is ';
        $totalprice = $request->get('total');
        $two0 = "00";
        $total = "$totalprice$two0";
 
        $session = \Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'USD',
                        'product_data' => [
                            "name" => $productname,
                        ],
                        'unit_amount'  => $total,
                    ],
                    'quantity'   => 1,
                ],
                 
            ],
            'mode'        => 'payment',
            'success_url' => route('success'),
            'cancel_url'  => route('checkout'),
        ]);
        // إنشاء كائن من StoreOrderRequest باستخدام بيانات الطلب
        $storeOrderRequest = StoreOrderRequest::createFrom($request);

        // إنشاء كائن من OrderController
        $orderController = new OrderController();

        // تمرير الطلب الصحيح
         $orderController->store($storeOrderRequest);


        // OrderController::store($request);
 
        return redirect()->away($session->url);
    }
 
    public function success()
    {
        return redirect('/order')->withsuccess('Thank You . Your Order done');;
        // return "Thanks for you order You have just completed your payment. The seeler will reach out to you as soon as possible";
    }



}
