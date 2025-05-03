@can("isAdmin")
@extends('admin.nav')
@section('mynav')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{URL::asset('/css/user.css')}}">
    <style>
table::-webkit-scrollbar {
  width: 5px;
  margin-left: 4px
}
table::-webkit-scrollbar-thumb {
  background: black; 
  border-radius: 10px;
}
    </style>

 
    <title> All Books</title>
</head>
<body style="overflow-x:hidden">
   <center> 

    <br>
    <h1 style="color: #CC5B23">All Books
      <span class="ms-4 ">&nbsp;&nbsp;&nbsp;&nbsp;count: 
        @if(!(App\Models\Book::get())->isEmpty())
        {{App\Models\Book::get()->count()}}
      
       @else
         0
     
     @endif    
    </span>

    </h1>
 
<br>

<div class=" " style="margin-left: 5%;">
    <div class="row">

      @forelse($data as $item)
     <div class="card mt-2 me-2 col-6  col-md-5 col-lg-4" style="height: 400px;background:#E5E7EB">

            <div class="row g-0">
              <div class="mt-1">
                <img src="{{URL::asset('/images/books/'.$item->photo)}}"  alt="..."  width="200px" height="150px">

                  </div>  
              <div  >
                <div class="card-body">
                  <h5 class="card-title">  {{substr($item->bookname,0,20)}}...</h5>
                  <p class="card-text" style="color: #212121;height:90px">{{substr($item->details,0,50)}}...</p>
                  <p class="card-text"><small class="text-muted">
                    Price: {{$item->price}}EG &nbsp; 
                    @if ($item->pdf !=null)
                    PDF :
                    <a href="/openpdf/{{$item->pdf}}" title="open pdf"
                       >{{$item->pdf}}</a>
                    @endif
                       
                   <br>
                   <span style="color: #0a0a0a">Statuse</span> : {{$item->statuse}} &nbsp;
                 <a href="/book/{{$item->id}}" title="show details"><i class="bi bi-eye-fill h4 text-success"></i></a>

              </small>
            <br></p>
                </div>
              </div>
            </div>
          </div>
 
          @empty
          <h1 style="color: rgb(108, 180, 244)" class="ms-0" > No  Books </h1>
      @endforelse
        
      
</div>
</div>


</center>
</body>
</html>
@endsection
@endcan
