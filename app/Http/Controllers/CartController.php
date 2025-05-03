<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;

class CartController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->only(['store','index','clearcart','updatebookquantaty','destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart=Cart::where('user_id',auth()->user()->id)->get();
        return view('user.cart',['data'=>$cart]);
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
    public function store(StoreCartRequest $request)
    {
        $input=$request->all();  
        $input['user_id']=auth()->user()->id;
        $bookexistes=Cart::where([['book_id',$request['book_id'],['user_id',auth()->user()->id]]])->get()->first();
        if($bookexistes ==null)
          Cart::create($input);
        else
          $bookexistes->update(array('quantaty' => $request['quantaty'] + $bookexistes['quantaty'] ));
          return redirect('/cart')->withSuccess("  Book Added To Cart  ");
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect('/cart')->withSuccess("  Book  Deleted  From  Cart  ");

    }


    public function clearcart()
    {
        $carts=Cart::where('user_id',auth()->user()->id)->get();
        foreach ($carts as $key ) 
        {
           $key->delete();
        }
        return redirect('/cart')->withSuccess("  Cart Cleard  ");

    }


    public function updatebookquantaty(Cart $cart)
    {
        $cart->quantaty=$_GET["quantaty"];
        $cart->update();
        return response()->json(['message' =>'done']);
    }
}
