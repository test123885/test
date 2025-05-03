<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Subscription=Subscription::get();
        return view('admin.Subscription',['data'=>$Subscription]);
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
    public function store(StoreSubscriptionRequest $request)
    {
         
        $mail=Subscription::where("email",$request['email'])->get();
        if(!($mail)->isEmpty())
        {
          return redirect()->back()->withSuccess('This Email Already Subscriped   ');
        }
      if (Auth::check()) 

           $name=auth()->user()->name;
       
      else
           $name="Anonymous user";
      
      Subscription::create([
                            'name'=>$name,
                            "email"=>$request['email']
                           ]);
      return redirect()->back()->withSuccess('Thank you for Subscription ');




    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
    {
        //
    }
 
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        //
    }
}
