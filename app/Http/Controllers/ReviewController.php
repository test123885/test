<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use Illuminate\Support\Facades\Notification;
use App\Notifications\createBookNotification;
use App\Models\User;

class ReviewController extends Controller
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
    public function store(StoreReviewRequest $request)
    {
        $input=$request->all();
        $input['user_id']=auth()->user()->id;
        Review::create($input);

        $user_create=auth()->user()->name;
        $users=User::where('id',$request->author_id)->get()->first();
        $tiltle="Add Comment to your Book";
       Notification::send($users, new createBookNotification($request->book_id,$user_create,$tiltle)); //$users->users that i will send notification 
       


        return back()->withSuccess(" Thank You For Your Review  ");
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
