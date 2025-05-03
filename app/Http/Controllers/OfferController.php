<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Http\Requests\StoreOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       if (Auth::check()) {
         
     
       
        $offer=Offer::where('author_id',auth()->user()->id)->get();
         
        if(auth()->user()->role=='admin')
          return view('admin.offer',['data'=>$offer]);
        else if(auth()->user()->role=='author')
          return view('auther.offer',['data'=>$offer]);
        else
         {
        $offers=Offer::get();

            return view('book.offer',['data'=>$offers]);
         } 
        } else {
            $offers=Offer::get();

            return view('book.offer',['data'=>$offers]);
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
    public function store(StoreOfferRequest $request) 
    {
        $offer=Offer::where('book_id',$request->book_id)->get();

        if(($offer)->isEmpty()){
            $input=$request->all();
            $input['author_id']=auth()->user()->id;
            Offer::create($input);
           
            
        }else{
            $off1=Offer::where('book_id',$request->book_id)->get()->first();
            $off1->update(array('offer' =>$request->offer )); 
        }
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Offer $offer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Offer $offer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOfferRequest $request, Offer $offer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offer $offer)
    {
        $offer->delete();
        return back();

    }
}
