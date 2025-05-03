<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
 use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{











    
   

// public function create(Order $order){
//     return view('payment',['order'=>$order]);

// }

// public function processPayment(Request $request)
// {
//     Stripe::setApiKey(env('STRIPE_SECRET'));

//     if (!$request->has('stripeToken')) {
//         return response()->json(['error' => 'لم يتم توفير رمز الدفع!'], 400);
//     }

//     $charge = \Stripe\Charge::create([
//         'amount' => 10000, // المبلغ بالسنت (100$)
//         'currency' => 'usd',
//         'source' => $request->stripeToken, // تمرير رمز الدفع
//         'description' => 'Custom Payment via Visa',
//     ]);

//     return response()->json(['message' => 'تم الدفع بنجاح!']);
// }
       

    }



