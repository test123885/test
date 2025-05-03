@extends('nav')
@section('mynav')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>search</title>
</head>
<body> 
 
  
   <div class="container ">
    <div class="  row  mb-4 " style="margin-top: 50px">
        <div class="col-4   p-4  ">
            
        <form action="/search" method="GET"  class="d-inline-block">
            @csrf
            <input class="form-control me-1 col-6 mb-2" type="search" placeholder="Search" aria-label="Search"  name="search" value="{{$message}}" required>
           
               
           

<div class="form-check form-check-inline ">
  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="book" name="check[]"   >
  <label class="form-check-label" for="inlineCheckbox1">Book</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="user" name="check[]"  >
  <label class="form-check-label" for="inlineCheckbox2">Author</label>
</div>
<div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="all" name="check[]"  checked>
    <label class="form-check-label" for="inlineCheckbox3">All</label>
  </div>
<div class="mb-2 mt-2">
 price :   <input id="num" type="range" value="100" max="10000" oninput="this.nextElementSibling.value = this.value" name="price">
<output>100</output>
</div class="mb-2">
  
<div class="mb-2 mt-2">
   Category : <select class="form-select" aria-label="Default select example" name="cat_id">
    <option value="0" name="cat">All</option>

        @foreach (App\Models\Category::get() as $collection   )

       <option value="{{$collection->id}}" name="cat">{{$collection->catname}}</option>
           
       @endforeach
       
     </select>
</div>
            <button class="btn btn-outline-success mt-1" type="submit">Search</button>
          </form>
        </div>
   
  
   <div class=" col-12 col-md-8   ">
    @forelse ($data as $item )
    {{-- @if(($item) !=null) --}}

    
    <div class="row col-12 mt-4 ms-4">
    <div class=" col-4">
        <a href="/details/{{$item->id}}" style="text-decoration: none">
        <img src="{{URL::asset('/images/books/'.$item->photo)}}" width="250px" height="250px" />
        </a>
    </div>
        <div class=" col-8">
             <h4  style="color: steelblue">{{$item->bookname}}
              
              <p class="text-danger d-inline">
              {{-- @forelse(App\Models\Rate::where('book_id',$item->id)->get()->groupBy('book_id')  as $item)
                  
              {{ROUND($item->AVG('rate'), 2)}} <i class="bi bi-star-half"></i> 
             @empty
               0 <i class="bi bi-star"></i>
             @endforelse --}}
              </p>
            
            </h4><br>
            <h6  style="color: rgb(89, 92, 94)">{{$item->details}}</h6><br>
            @if (App\Models\Offer::where('book_id',$item->id)->get()->first() !=null)

                
            Price :  <span class="text-decoration-line-through " style="color: slategrey">EGP{{$item->price}}</span> <br>
            Offer :EGP{{App\Models\Offer::where('book_id',$item->id)->get()->value('offer')}}
        @else
           Price : EGP  {{$item->price}}
        @endif


            <h4 style="color: steelblue">{{App\Models\User::where('id',$item->author_id)->get()->value("name")}}</h4>
            
        </div>
         
        <hr class="mt-4">
    </div>
    {{-- @endif --}}
@empty
    <h1 class="mt-4"> Your Search Not Found</h1>
@endforelse
   </div>
</div>
</div>
<div class="mt-4">
    <br><br><br>
@include('user.subscription')

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
@endsection