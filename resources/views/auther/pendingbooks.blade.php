@extends('nav')
@section('mynav')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{URL::asset('/css/user.css')}}">
    <style>


    </style>

 
    <title> Pending Book</title>
</head>
<body  
style="background-color: rgb(239, 238, 238);overflow-x: hidden"
>
   
 
<br>
 
<div class=" " style="margin-left:10%;margin-top: 50px">
    <div class="row">

         
      @forelse ($data as $item)
          
    
          <div class="card mt-2 me-1 col-6  col-md-4 col-lg-3" style="height: 400px" >
            <div class="row g-0">
              <div class="mt-2">
                <img src="{{URL::asset('/images/books/'.$item->photo)}}"  alt="..."  width="300px" height="150px">
              </div>
              <div  >
                <div class="card-body">
                  <h5 class="card-title">  {{substr($item->bookname,0,30)}}...</h5>
                  <p class="card-text" style="color: #212121">{{substr($item->details,0,50)}}...</p>
                  <p class="card-text"><small class="text-muted"> 
                    Price:{{$item->price}} EG &nbsp; 
                    @if ($item->pdf !=null)
                        
                     PDF :
                    <a href="/openpdf/{{$item->pdf}}" title="open pdf"
                       >{{$item->pdf}}</a>
                    @endif
                     
                   





                   
                
                </small></p>
                </div>
              </div>
            </div>
          </div>

          
          @empty
             <h1 class="text-danger text-left mt-4 "   >
     You Have no  Pending Books
     </h1>   
      @endforelse
      
</div>
</div>



 

    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
@endsection
