<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Checkout;
use App\Models\Cart;
use App\Models\User;
use App\Models\Book;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Support\Facades\Notification;
use App\Notifications\createOrderNotification;
class OrderController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->role =='admin')
        {
            
        $Order=Order::get()->sortDesc()->groupBy('checkout_id');
         return view("admin.orders",["data"=>$Order]);
        }elseif (auth()->user()->role =='user') {
            $Order=Order::where('user_id',auth()->user()->id)->get()->sortDesc()->groupBy('checkout_id');
            return view("user.myorder",["data"=>$Order]);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
       $input=$request->all();
       $Checkout=Checkout::create($input);
       $order['user_id']=auth()->user()->id;
       $order['checkout_id']=$Checkout->id;
       $order['statuse']="pending";  
       $cart=Cart::where('user_id',auth()->user()->id)->get();
       foreach ($cart as $key ) 
       {
            $order['book_id']=$key->book_id;
            $order['author_id']=Book::where('id',$key->book_id)->get()->value('author_id');
            $order['quantaty']=$key->quantaty;
            Order::create($order);
            $key->delete();
            $user_create=auth()->user()->name;
            $users=User::where('id',$order['author_id'])->get()->first();
            $admins=User::where('role','admin')->get()->first();
            $tiltle="You have new Order from " . $user_create;
            Notification::send($admins, new createOrderNotification($order['checkout_id'],$tiltle)); //$users->users that i will send notification 
            Notification::send($users, new createOrderNotification($order['checkout_id'],$tiltle)); //$users->users that i will send notification 
           
    
            
        }
             return redirect('/order')->withsuccess('Thank You . Your Order done');
            //  return view('paymentvisa');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }


    public function orderdetails($id)
    {
        $order=Order::where([['checkout_id',$id]])->get();
        if(auth()->user()->role =='admin')
          return view('admin.orderdetails',['data'=>$order]);
        else
          return view('auther.orderdetails',['data'=>$order]);

    }


   public function updateorderstatuse($id)
   {
    $order=Order::where([['checkout_id',$id]])->get();
    if ($_GET["status"]=="canceld") 
    $stat_of_order="Out Of Stock";
    else  if ($_GET["status"]=="pending") 
    $stat_of_order="pending";
    else  
    $stat_of_order="deleverd within three days";
    foreach ($order as $key ) 
    {

        $key->statuse=$_GET["status"];
        $key->update();
        $book_name=Book::where('id',$key->book_id)->get()->value('bookname');
        // $user_create=auth()->user()->name;
        $users=User::where('id',$key->user_id)->get()->first();
        $authors=User::where('id',$key->author_id)->get()->first();
   
        
        $tiltle=" Order Is " . $stat_of_order ." for " . $book_name . " Booked  by " . auth()->user()->name;
        Notification::send($users, new createOrderNotification($key->checkout_id,$tiltle)); //$users->users that i will send notification 
        Notification::send($authors, new createOrderNotification($key->checkout_id,$tiltle)); //$users->users that i will send notification 
       

    }
    return response()->json(['message' =>$_GET["status"]]);

   }



    public function pendingorders()
    {
        $pendingordersauthor=Order::where([['author_id',auth()->user()->id],["statuse","pending"]])->get()->sortDesc()->groupBy('checkout_id');
        $pendingorders=Order::where([["statuse","pending"]])->get()->sortDesc()->groupBy('checkout_id');
        if(auth()->user()->role =='admin')
           return view('admin.pendingorders',["data"=>$pendingorders]);
        else
           return view('auther.pendingorders',["data"=>$pendingordersauthor]);
    
    }


    public function canceldorders()
    {
        
        $canceldorders=Order::where([['author_id',auth()->user()->id],["statuse","canceld"]])->get()->sortDesc()->groupBy('checkout_id');
        $canceldordersadmin=Order::where([["statuse","canceld"]])->get()->sortDesc()->groupBy('checkout_id');
        if(auth()->user()->role =='admin')
           return view('admin.canceldorders',["data"=>$canceldordersadmin]);
        else
           return view('auther.canceldorders',["data"=>$canceldorders]);
    }


    public function deleverdorders()
    {
        $deleverdorders=Order::where([['author_id',auth()->user()->id],["statuse","deleverd"]])->get()->sortDesc()->groupBy('checkout_id');
        $deleverdordersadmin=Order::where([["statuse","deleverd"]])->get()->sortDesc()->groupBy('checkout_id');
        if(auth()->user()->role =='admin')
           return view('admin.deleverdorders',["data"=>$deleverdordersadmin]);
        else
           return view('auther.deleverdorders',["data"=>$deleverdorders]);
    }

    public function userbooks(){
 
        $orders=Order::where([['user_id',auth()->user()->id],["statuse","deleverd"]])->orderBy('updated_at','desc' )->get()->groupBy('checkout_id');

return view('user.mybooks',["data"=>$orders]);
    }
}
