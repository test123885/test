<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Block;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;
use App\Notifications\createBlockNotification;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=User::where('role','!=','admin')->get();
        return view('admin.alluser',["data"=>$users]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $input=$request->all();
        if (request()->hasFile('photo')){
            $photo = request()->file('photo');
           $unique_name =time().'.'.$photo->getClientOriginalExtension();
           $photo->move(public_path('/images/profile'),$unique_name);
           $input['photo']=$unique_name;
            
       }

        $user->update($input);
        return redirect("/user/profile");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
    public function bookrequest(){
        $books=Book::where('statuse','pending')->get();
        return view("admin.bookrequest",['data'=>$books]);

    }
    public function blockuser($id){
        $user_create=auth()->user()->name;
        $users=User::where('id',$id)->get()->first();
        $input["user_id"]=$id;
        $userblocked=Block::where('user_id',$id)->first();
        $authorbook=Book::where('author_id',$id)->get();
        if($userblocked){

        $userblocked->delete();
        $blocked="has UnBlocked Your account";       

        foreach ($authorbook as $key) {
            $key->update(array('statuse' => 'published'));  
        }
Notification::send($users, new createBlockNotification($user_create,$blocked)); //$users->users that i will send notification 

        return back()->withSuccess("  User   unblock ");

        }
         else
         {
        Block::create($input);
        $blocked="has Blocked Your account";       
      

        foreach ($authorbook as $key) {
            $key->update(array('statuse' => 'canceld'));  
        }
Notification::send($users, new createBlockNotification($user_create,$blocked)); //$users->users that i will send notification 

        return back()->withSuccess("  User   blocked ");
         }
    }
public function allauthors(){
    $allAuthors = User::where('role', '!=', 'user')
    ->whereHas('books') // لديه كتب
    ->whereDoesntHave('block') // ليس محظورًا
    ->get();

return view('user.allauthors', ['data' => $allAuthors]);


}

public function authorbook($id){
    $books=Book::where([['statuse','published'],['author_id',$id]])->get();
        return view("book.authorbook",['data'=>$books]);

    
}

public function explain(){
     
    $question=$_GET["question"];
    $responses = Http::get('http://localhost:3000/data', [
        'question' => $question,
        
    ]);
   
    return response()->json(['message' =>$responses->object()]);

    
}
public function users(){
     
    $users=User::where('role','user')->get();
     
    return view('admin.users',["data"=>$users]);
}
public function authors(){
    $users=User::where('role','author')->get();
    return view('admin.authors',["data"=>$users]);
}
public function notification(){
    $user =User::find(auth()->user()->id);
    foreach ($user->unreadNotifications as $notification) {
        $notification->markAsRead();
    }

    if(auth()->user()->role =='admin') 
{
    return view("admin.notification");
     
} else if(auth()->user()->role =='author')
{
    return view("auther.notification");

    
} else{
    return view("user.notification");

}


}  
}
