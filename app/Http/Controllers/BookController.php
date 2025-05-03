<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Block;
use App\Models\Category; 
use App\Models\Order;
use App\Models\Offer;
use App\Models\Rate;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;
use App\Notifications\createBookNotification;
use App\Notifications\createBookRequestNotification;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{

    public function __construct(){
        $this->middleware('auth')->except(['index','show','openpdf','details','newbooks','kidsbook','bestselling','search','recommended','updatepageofcategory','filterprice']);
    }
    /**
     * Display a listing of the resource.
     */ 
    public function index()
    {
        $books=Book::get()->sortDesc();
        return view('admin.allbook',['data'=>$books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auther.addbook');
    }
   

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $blockeduser=Block::where('user_id',auth()->user()->id)->get()->first();
        
        if($blockeduser)
        return back()->withSuccess("  You Can`t  Add book becouse you are blocked ");

       $input=$request->all();
       $input['author_id']=auth()->user()->id;
       if($request->hasFile('photo'))
       {
           $photo = request()->file('photo');
           $unique_name =time().'.'.$photo->getClientOriginalExtension();
           $photo->move(public_path('/images/books'),$unique_name);
           $input['photo']=$unique_name;
       }
       if($request->hasFile('pdf'))
       {
           $pdf = request()->file('pdf');
           $pdf_name =time().'.'.$pdf->getClientOriginalExtension();
           $pdf->move(public_path('/pdf'),$pdf_name);
           $input['pdf']=$pdf_name;
       }
       if(auth()->user()->role =="admin")
        $input['statuse']="published";
       else
       $input['statuse']="pending";
    
      $book=Book::create($input);
      if(auth()->user()->role =='admin')
        return redirect("/adminbooks")->withSuccess("  Book    Added ");
      else {
        $request_book='add';
        $user_create=auth()->user()->name;
        $users=User::where('role','admin')->get();
        $tiltle= $user_create . " Request to published his Book";
        Notification::send($users, new createBookRequestNotification($request_book,$tiltle)); //$users->users that i will send notification 
       



        return back()->withSuccess(" your book is pending ");
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    { 
        
        if(auth()->user()->role=='admin')
          return view('admin.showbook',['data'=>$book]);
        else
          return view('book.details',['data'=>$book]);

    }

    
    public function updatebooktatuse(Book $book)
    {

        $user_create=auth()->user()->name;
        $users=User::where('id',$book->author_id)->get()->first();
        $tiltle="changed your status book to " . $_GET["status"] ;
       Notification::send($users, new createBookNotification($book->id,$user_create,$tiltle)); //$users->users that i will send notification 
    
        $book->statuse=$_GET["status"];
        $book->update();
        return response()->json(['message' =>$_GET["status"]]);
    }
public function updatepageofcategory(){

if($_GET["offer"] == 0){
    $books=Book::leftJoin('offers', 'books.id', '=', 'offers.book_id')
    ->select('books.*', 'offers.offer')
    ->where([["cat_id",$_GET["catid"]],["statuse","published"]])->orderBy('price',$_GET["price"] )->get();

}else{

    // $offer=Offer::pluck('book_id')->toArray();
    // $books=Book::leftJoin('offers', 'books.id', '=', 'offers.book_id')
    // ->select('books.*', 'offers.offer')->
    // where([["cat_id",$_GET["catid"]],["statuse","published"]])->whereIn('id', $offer)
    // ->orderBy('price',$_GET["price"] )->get();


    $offerBookIds = Offer::pluck('book_id')->toArray();

    $books = Book::leftJoin('offers', 'books.id', '=', 'offers.book_id')
       ->select('books.*', 'offers.offer')
       ->where('cat_id', $_GET["catid"])
       ->where('statuse', 'published')
       ->whereIn('books.id', $offerBookIds)  
       ->orderBy('books.price', $_GET["price"])
       ->get();
}


    return response()->json(['books' =>$books]);

}

public function filterprice(){
    
if($_GET["offer"] == 0){
    $books=Book::leftJoin('offers', 'books.id', '=', 'offers.book_id')
    ->select('books.*', 'offers.offer')->
    where([["cat_id",$_GET["catid"]],["statuse","published"]])
    ->whereBetween('price', [$_GET["minprice"], $_GET["maxprice"]])
    ->orderBy('price',$_GET["price"] )->get();

}else{

 
    $offerBookIds = Offer::
    whereBetween('offer', [$_GET["minprice"], $_GET["maxprice"]])
    ->pluck('book_id')
    ->toArray();

    $books = Book::leftJoin('offers', 'books.id', '=', 'offers.book_id')
       ->select('books.*', 'offers.offer')
       ->where('cat_id', $_GET["catid"])
       ->where('statuse', 'published')
       ->whereIn('books.id', $offerBookIds) 
    ->orderBy('price',$_GET["price"] )->get();

}


    return response()->json(['books' =>$books]);
}
   public function acceptbook(Book $book)
   {


    $user_create=auth()->user()->name;
    $users=User::where('id',$book->author_id)->get()->first();
    $tiltle="Published Your Book";
   Notification::send($users, new createBookNotification($book->id,$user_create,$tiltle)); //$users->users that i will send notification 



    $book->statuse="published";
    $book->update();
    return back()->withSuccess("  Book    Added ");

   }


   public function adminbooks()
   {
        $adminbooks=Book::where('author_id',auth()->user()->id)->get()->sortDesc();
        return view('admin.adminbooks',["data"=>$adminbooks]);
    }


    public function openpdf($pdf)
    {
       
        return view('openpdf',["data"=>$pdf]);

    } 
    public function download($pdf)
    {
       
        $download_path =( public_path() . '/pdf/'.$pdf);
        return response()->download($download_path);

    } 
    

    public function addbook()
    {
        return view('admin.addbook');
    }


    public function authorbooksforadmin($id)
    {

      $authorbook=Book::where('author_id',$id)->get();
      return view('admin.authorbook',["data"=>$authorbook]);
  
    }


    public function details($id)
    {
        $book=Book::where("id",$id)->get()->first();
        return view('book.details',['data'=>$book]);
    }


    public function authorownbook()
    {
        $authorbook=Book::where([['author_id',auth()->user()->id],["statuse","published"]])->get()->sortDesc();
        return view('auther.authorbook',["data"=>$authorbook]);
    }

     
    public function pendingbooks()
    {
        
        $pendingbooks=Book::where([['author_id',auth()->user()->id],["statuse","pending"]])->get()->sortDesc();
        return view('auther.pendingbooks',["data"=>$pendingbooks]);
    }


  public function canceldbooks()
  {
        
    $canceldbooks=Book::where([['author_id',auth()->user()->id],["statuse","canceld"]])->get()->sortDesc();
    return view('auther.canceldbooks',["data"=>$canceldbooks]);
  }

 
 public function newbooks()
 {

    $books=Book::where("statuse","published")->get()->sortDesc();
    return view('book.newbooks',['data'=>$books]);
 }



 public function kidsbook()
 {
      $catid=Category::where('catname','kids')->get()->value('id');
     $book=Book::where([['cat_id',$catid],["statuse","published"]])->get()->sortDesc();
      return view('book.kidsbook',['data'=>$book]);
 }


 public function bestselling()
 {
     $books=Order::orderByDesc('quantaty')->get()->groupBy('book_id');
     return view('book.bestselling',['data'=>$books]);

 }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
         if(auth()->user()->role =="admin")
           return view('admin.editbook',["data"=>$book]);
        else
          return view('auther.editbook',["data"=>$book]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
     
        $blockeduser=Block::where('user_id',auth()->user()->id)->get()->first();
        
        if($blockeduser)
        return back()->withSuccess("  You Can`t  Add Update becouse you are blocked ");
        
        $input=$request->all();

        if($request->hasFile('photo'))
        {
            $photo = request()->file('photo');
            $unique_name =time().'.'.$photo->getClientOriginalExtension();
            $photo->move(public_path('/images/books'),$unique_name);
            $input['photo']=$unique_name;
        }

        if($request->hasFile('pdf'))
        {
            $pdf = request()->file('pdf');
            $pdf_name =time().'.'.$pdf->getClientOriginalExtension();
            $pdf->move(public_path('/pdf'),$pdf_name);
            $input['pdf']=$pdf_name;
        }
        $book->update($input);
        if(auth()->user()->role =="admin")
          return redirect("/adminbooks")->withSuccess("  Book   Udated ");
       else
        {
            $request_book="update";
            $user_create=auth()->user()->name;
            $users=User::where('role','admin')->get();
            $tiltle= $user_create . " Update his Book";
    Notification::send($users, new createBookRequestNotification($request_book,$tiltle)); //$users->users that i will send notification 
               
            $book->update(array('statuse' => 'pending'));
            return redirect("/authorownbook")->withSuccess("  Book   Udate is pending ");
        }
}


  public function search(Request $request)
  {
//  dd($request);
    if(session()->has('searchdata'))
    Session::push('searchdata',$request->search);
    else
    Session::put('searchdata',[$request->search]);
    if($request->has('check'))
    { 
      $checkes = $request->input('check');
foreach($checkes as $check){
 if ($check =="book") {

    if($request->cat_id == 0)
    $books=Book::where([['bookname', 'like', "%$request->search%"],["statuse","published"],['price','<=',$request->price]])->get();
    else{
        if(session()->has('searchdatacat'))
        Session::push('searchdatacat',$request->cat_id);
        else
        Session::put('searchdatacat',[$request->cat_id]);
    $books=Book::where([['bookname', 'like', "%$request->search%"],["statuse","published"],['price','<=',$request->price],['cat_id',$request->cat_id]])->get();
}

    $merged =$books;
 } elseif ($check =="user") {
     
    $users=User::where('name', 'like', "%$request->search%")->get();
    if($request->cat_id == 0){
      foreach ($users as $key ) {
    $book=Book::where([['author_id',$key->id],["statuse","published"],['price','<=',$request->price]])->get();
    $merged =$book;
        }
    }else{
        
        if(session()->has('searchdatacat'))
        Session::push('searchdatacat',$request->cat_id);
        else
        Session::put('searchdatacat',[$request->cat_id]);
        foreach ($users as $key ) {
            $book=Book::where([['author_id',$key->id],["statuse","published"],['price','<=',$request->price],['cat_id',$request->cat_id]])->get();
            $merged =$book;
                }
    }

 } else
 {

    if($request->cat_id == 0) 
    $books=Book::where([['bookname', 'like', "%$request->search%"],["statuse","published"],['price','<=',$request->price]])->get();
    else
    {
        
        if(session()->has('searchdatacat'))
        Session::push('searchdatacat',$request->cat_id);
        else
        Session::put('searchdatacat',[$request->cat_id]);
        $books=Book::where([['bookname', 'like', "%$request->search%"],["statuse","published"],['price','<=',$request->price],['cat_id',$request->cat_id]])->get();

    }


    $merged =$books;

    $users=User::where('name', 'like', "%$request->search%")->get();
    if($users !=null)
    {
    if($request->cat_id == 0) 
{
        foreach ($users as $key ) {
    $book=Book::where([['author_id',$key->id],["statuse","published"],['price','<=',$request->price]])->get();
    $merged = $books->merge($book);
        }
    }else{
        foreach ($users as $key ) {
            $book=Book::where([['author_id',$key->id],["statuse","published"],['price','<=',$request->price],['cat_id',$request->cat_id]])->get();
            $merged = $books->merge($book);
                } 
    }
    }
    else
      $merged =$books;

 }
 
}


    }
    else
    {

    $books=Book::where([['bookname', 'like', "%$request->search%"],["statuse","published"]])->get();
    $merged =$books;

    $users=User::where('name', 'like', "%$request->search%")->get();
    if($users !=null)
    {
        foreach ($users as $key ) {
    $book=Book::where([['author_id',$key->id],["statuse","published"]])->get();
    $merged = $books->merge($book);
        }
        
    }
    else
      $merged =$books;
}
//  dd($merged);
    return view("search")->with('data',$merged)->with('message',$request->search);
 
  }
  
  
public function recommended(){
    $merged = collect();
if(Auth::check()) 
{
     $category_id=Category::where('catname','like','%kids%')->get()->value('id');
     $category_femal_id=Category::where('catname','like','%fation%')
     ->orWhere('catname','like','%arts%')->get()->pluck('id');
     $category_mal_id=Category::where('catname','like','%sports%')
     ->orWhere('catname','like','%history%')->get()->pluck('id');
     $book_cart=Cart::where('user_id',auth()->user()->id)->get()->pluck('book_id');
     $book_Rate=Rate::where([['user_id',auth()->user()->id],['rate','>','3']])->get()->pluck('book_id');
     $book_Order=Order::where('user_id',auth()->user()->id)->get()->pluck('book_id');
    //  dd($category_femal_id);$category_mal_id
 $age=auth()->user()->age;
 $gendar=auth()->user()->gendar;
 
 if ($book_Order !=null){
    $book_Orders=Book::where([["statuse","published"]])->whereIn('id',$book_Order)->get('cat_id')->groupBy('cat_id');
    foreach ($book_Orders->keys() as $book_Order  ) {
    
        $book_Orde=Book::where([["statuse","published"],['cat_id',$book_Order]])->take(5)->latest()->get();
        foreach ($book_Orde as $key => $value) {
            if (!$merged->contains('id',$value->id)) {
                $merged->push($value);
        
                
                 
                    }
           }
    }
}
 
// dd( $merged);
// $book_cart=Cart::where('user_id',auth()->user()->id)->get()->pluck('book_id');
if ($book_cart !=null){
    $book_categoes=Book::where([["statuse","published"]])->whereIn('id',$book_cart)->get('cat_id')->groupBy('cat_id');
    foreach ($book_categoes->keys() as $book_categoe  ) {

    $book_category=Book::where([["statuse","published"],['cat_id',$book_categoe]])->take(3)->latest()->get();
   foreach ($book_category as $key => $value) {
    if (!$merged->contains('id',$value->id)) {
        $merged->push($value);

        
         
            }
   }
}
    }

if ($book_Rate !=null){

     $book_Rates=Book::where([["statuse","published"]])->whereIn('id',$book_Rate)->get('cat_id')->groupBy('cat_id');
    foreach ($book_Rates->keys() as $book_Rate  ) {
    
        $book_Rat=Book::where([["statuse","published"],['cat_id',$book_Rate]])->latest()->take(3)->get();
        foreach ($book_Rat as $key => $value) {
            if (!$merged->contains('id',$value->id)) {
                $merged->push($value);
        
                
                 
                    }
           }
    }
}

if(session()->has('searchdatacat'))
{
     
 $valu=session()->get('searchdatacat');
// $books=Book::whereIn('cat_id', $valu)->get()->groupBy('cat_id');

// foreach ($books as $key => $value) {
//     if (!$merged->contains('id',$value->id)) {
//         $limitedBooks = $value->take(2);
//         $merged->push($limitedBooks);

        
         
//             }
//    }

$books = Book::whereIn('cat_id', $valu)->get()->groupBy('cat_id');
foreach ($books as $cat_id => $bookGroup) {
    foreach ($bookGroup as $book) { 
        if (!$merged->contains('id', $book->id)) {
            $merged->push($book);
        }
        if ($merged->where('cat_id', $cat_id)->count() >= 2) {
            break;  
        }
    }
}

    $users=User::whereIn('name', $valu)->get();
    if($users !=null)
    {
        foreach ($users as $key ) {
    $book=Book::where([['author_id',$key->id],["statuse","published"]])->take(5)->latest()->get();
    foreach ($book as $key => $value) {
        if (!$merged->contains('id',$value->id)) {
            $merged->push($value);
    
            
             
                }
       }
        }
    }
    

  }


if(session()->has('searchdata'))
{
     
 $valu=session()->get('searchdata');
$books=Book::whereIn('bookname', $valu)->get()->groupBy('cat_id');


// foreach ($books as $key => $value) {
//     if (!$merged->contains('id',$value->id)) {
//         $merged->push($value);

        
         
//             }
//    }

 
   foreach ($books as $cat_id => $bookGroup) {
    foreach ($bookGroup as $book) {        
        if (!$merged->contains('id', $book->id)) {
            $merged->push($book);
        }
        if ($merged->where('cat_id', $cat_id)->count() >= 2) {
            break; 
        }
    }
}








    $users=User::whereIn('name', $valu)->get();
    if($users !=null)
    {
        foreach ($users as $key ) {
    $book=Book::where([['author_id',$key->id],["statuse","published"]])->take(2)->latest()->get();
    foreach ($book as $key => $value) {
        if (!$merged->contains('id',$value->id)) {
            $merged->push($value);
    
            
             
                }
       }
        }
    }
    

  }

  if($age <= "15")
  {
  
      $books=Book::where([["statuse","published"],['cat_id',$category_id]])->take(10)->latest()->get();
      foreach ($books as $key => $value) {
        if (!$merged->contains('id',$value->id)) {
            $merged->push($value);
    
            
             
                }
       }
   
  }else{

    if($gendar == "female"){
        // $books=Book::where([["statuse","published"]])->whereIn('cat_id', $category_femal_id)->get();
        // dd($books);
        // foreach ($books as $key => $value) {
        //   if (!$merged->contains('id',$value->id)) {
        //       $merged->push($value);
      
              
               
        //           }
        //  }


        $books=Book::where([["statuse","published"]])->whereIn('cat_id', $category_femal_id)->get()->groupBy('cat_id');

        // $books = Book::whereIn('cat_id', $valu)->get()->groupBy('cat_id');
 
foreach ($books as $cat_id => $bookGroup) {
    foreach ($bookGroup as $book) {     
        if (!$merged->contains('id', $book->id)) {
            $merged->push($book);
        }
        if ($merged->where('cat_id', $cat_id)->count() >= 4) {
            break;
        }
    }
}

    }else 
    {
        $books=Book::where([["statuse","published"]])->whereIn('cat_id', $category_mal_id)->get()->groupBy('cat_id');
      
foreach ($books as $cat_id => $bookGroup) {
    foreach ($bookGroup as $book) {     
        if (!$merged->contains('id', $book->id)) {
            $merged->push($book);
        }
        if ($merged->where('cat_id', $cat_id)->count() >= 4) {
            break;
        }
    }
}
    }
    

  }






return view("book.recommended")->with('data',$merged);



  }else
  {
   
    $books=Order::orderByDesc('quantaty')->get()->groupBy('book_id');

return view("book.recommended")->with('bestbook',$books);

  }

  
//  dd($merged);



}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return back()->withSuccess("  Book   Deleted ");
    }






  
 
   





}
