<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use App\Http\Requests\StoreRateRequest;
use App\Http\Requests\UpdateRateRequest;
use Illuminate\Support\Facades\Notification;
use App\Notifications\createBookNotification;
use App\Models\User;
class RateController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    } 
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreRateRequest $request)
    {
        
        $input=$request->all();
        $input['user_id']=auth()->user()->id;
        $rate=Rate::where([['user_id',auth()->user()->id],['book_id',$input['book_id']]])->get()->first();
        if($rate == null)
        Rate::create($input);
       else
       $rate->update(array('rate' => $input['rate']));

       $user_create=auth()->user()->name;
       $users=User::where('id',$request->author_id)->get()->first();
       $tiltle="Add Rate to your Book";
      Notification::send($users, new createBookNotification($request->book_id,$user_create,$tiltle)); //$users->users that i will send notification 
      
        return back()->withSuccess(" Thank You For Your Rate  ");
    }

    /**
     * Display the specified resource.
     */
    public function show(Rate $rate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rate $rate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRateRequest $request, Rate $rate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rate $rate)
    {
        //
    }
}
