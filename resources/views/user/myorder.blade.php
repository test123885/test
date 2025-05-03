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
    

<div class="container mt-4">
   

<div class="row">
    @forelse ($data as $item)
    <div class="card-deck">
        <div class="card mb-2">
           <div class="card-body">
            <h5 class="card-title">Orders :</h5>
            <p class="card-text">
   @foreach ($item as $itemes)

                <img src="{{URL::asset('/images/books/'.App\Models\Book::where('id',$itemes->book_id)->get()->value('photo'))}}" style="height: 70px;width:70px;display:inline" class="me-1 mb-1"   />
                @endforeach

            </p>
            <h5 class="card-title">Order Statuse :
                @foreach ($item as $it)
                @if ($loop->first)
                {{$it->statuse}}
                


            </h5>
            <p class="card-text">
                 <div class="progress">
        <div class="progress-bar progress-bar-striped @if($it->statuse =='deleverd') w-100 bg-success @elseif($it->statuse =='pending')  w-50 bg-info @else w-25 bg-danger @endif " role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
      @endif
                @endforeach
            </p> 
            </div>
        </div>
     
      </div>
      @empty
      <h1 class="text-center"> You Don`t Have any Orders</h1>

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
