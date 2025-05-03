@extends('nav')
@section('mynav')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
<br>
<div class="container mt-4">
   

<div class="row">
    @forelse ($data as $item)
   @foreach ($item as $itemes)


   <div class="card mb-3 ms-1"  style="max-width: 540px;">
    <div class="row g-0">
      <div class="col-md-4">
        <img src="{{URL::asset('/images/books/'.App\Models\Book::where('id',$itemes->book_id)->get()->value('photo'))}}" style="height: 200px;width:180px;" class="me-1 mb-1 pt-2 "   />

      </div>
      <div class="col-md-8 col-lg-5 ms-1">
        <div class="card-body">
          <h5 class="card-title">{{App\Models\Book::where('id',$itemes->book_id)->get()->value('bookname')}}</h5>
          <p class="card-text pt-2"> 
            <a class="dropdown-item asd" href="/openpdf/{{App\Models\Book::where('id',$itemes->book_id)->get()->value('pdf')}}" title="open book pdf" >
                Read Book</a>

                <a class="dropdown-item asd" href="/download/{{App\Models\Book::where('id',$itemes->book_id)->get()->value('pdf')}}" title="download book pdf" >
                   Download Book</a>

                   <a class="dropdown-item asd" href="#" title="convert book pdf" >
                    Convert Book</a>
          </p>
         </div>
      </div>
    </div>
  </div>



{{-- 
    <div class="card-deck">
        <div class="card mb-2">
           <div class="card-body">
            <h5 class="card-title">{{App\Models\Book::where('id',$itemes->book_id)->get()->value('bookname')}}</h5>
            <p class="card-text">

                <img src="{{URL::asset('/images/books/'.App\Models\Book::where('id',$itemes->book_id)->get()->value('photo'))}}" style="height: 100px;width:100px;display:inline" class="me-1 mb-1"   />
               <p style="display: inline">
                 {{App\Models\Book::where('id',$itemes->book_id)->get()->value('bookname')}} <br>
                
                <a href="/openpdf/{{App\Models\Book::where('id',$itemes->book_id)->get()->value('pdf')}}" title="open book pdf" >
                    {{App\Models\Book::where('id',$itemes->book_id)->get()->value('pdf')}}</a>
                </p>
                </p>
             
            
            </div>
        </div>
     
      </div> --}}
      @endforeach

      @empty
      <h1 class="text-center"> You Don`t Have any Books</h1>

      @endforelse

</div>



</div>
 
 


    <br>
    <div class="mt-4 ">
       
       @include('user.subscription')
    
    </div>
     
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>
</html>
@endsection
