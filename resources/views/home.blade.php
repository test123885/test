@extends('auther.nav')
@section('mynav')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<style> 
    .test :hover{
width: 270px;
height: 270px;
    }
</style>
<body>
    @if(Session::has('success'))
    <div class="alert alert-success" role="alert" style="background-color: #0e3554;color:azure;margin-bottom: -20px;margin-left:300px; width:56%; margin-top:50px;font-weight:bolder;text-align:center;" >
      {{Session::get('success')}}
    </div>
    @endif
  <br><br>
<div >

    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" >
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{URL::asset('/images/Carsel3.PNG')}}" class="d-block w-100" alt="..." height="420px">
                <div class="carousel-caption d-none d-md-block">
                
                  <h1><a name=""   id=""  class="btn btn-warning p-2 w-40" href="/newbooks" role="button" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; New  Books &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                    
                
                </div>
              </div>
          <div class="carousel-item ">
            <img src="{{URL::asset('/images/Carsel1.PNG')}}" class="d-block w-100" alt="..." height="420px">
            <div class="carousel-caption d-none d-md-block ">
              <h1><a name=""   id=""  class="btn btn-warning p-2 w-40" href="/bestselling" role="button" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Best  Seller &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
              </h1>
             </div>
          </div>
          <div class="carousel-item">
            <img src="{{URL::asset('/images/Carsel2.PNG')}}" class="d-block w-100" alt="..." height="420px">
            <div class="carousel-caption d-none d-md-block">
                <h1><a name=""   id=""  class="btn btn-warning p-2 w-40" href="/recommended" role="button" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Recommended Books &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
              
            </div>
          </div>

        </div>
        
      </div> 






</div>

<div  class="container mt-3 mb-3">
<center class="mb-4 h1" > New Books</center>
<div class="row">
@foreach (App\Models\Book::where("statuse","published")->get()->sortDesc()->take(4) as $item)
    <div class="  col-3 test">
    <a href="/details/{{$item->id}}" style="text-decoration: none ">
    <figure >
        <img src="{{URL::asset('/images/books/'.$item->photo)}}" width="250px" height="250px" />
        <figcaption class="text-center mt-1  ">
            <h4  style="color: steelblue">{{$item->bookname}}</h4>
            <h4 style="color: slategray">{{App\Models\User::where('id',$item->author_id)->get()->value('name')}}</h4>
            <h4 style="color: slategrey">EGP {{$item->price}} </h4>
        </figcaption>
        </figure>
    </a>
</div>
@endforeach

</div>
<div class="display-block text-end mt-4 mb-4">
<a href="/newbooks" style="text-decoration: none;color:rgb(106, 102, 102);"> See all</a>
</div>
</div>
<hr style="width: 90%;margin-left:60px">

<div  class="container mt-3 mb-4">
    <center class="mb-4 h1" > Kids Books</center>
    <div class="row">
    @php
        $catid=App\Models\Category::where('catname','kids')->get()->value('id');
        $book=App\Models\Book::where([['cat_id',$catid],["statuse","published"]])->get()->sortDesc()->take(4);
    @endphp
@foreach ($book as $item)
        
    <div class="  col-3 test">
        <a href="/details/{{$item->id}}" style="text-decoration: none ">
        <figure >
            <img src="{{URL::asset('/images/books/'.$item->photo)}}" width="250px" height="250px" />
            <figcaption class="text-center mt-1  ">
                <h4  style="color: steelblue">{{$item->bookname}}</h4>
                 <h4 style="color: slategray">{{App\Models\User::where('id',$item->author_id)->get()->value('name')}}</h4>
                <h4 style="color: slategrey">EGP {{$item->price}} </h4>
            </figcaption>
            </figure>
        </a>
    </div>
@endforeach
    </div>
    <div class="display-block text-end mt-4 mb-4">
    <a href="/kidsbook" style="text-decoration: none;color:rgb(106, 102, 102);"> See all</a>
    </div>
    </div>
    <hr style="width: 90%;margin-left:60px">
   
    
<div  class="container mt-3 mb-4">
    <center class="mb-4 h1" > Top Authors</center>
    <div class="row">
    
    @foreach (App\Models\Order::orderByDesc('quantaty')->get()->groupBy('author_id')->take(4) as $item)
       @foreach ($item as $key)
       @if ($loop->first)
       <div class="  col-3 test">
        <a href="/authorbook/{{$key->author_id}}" style="text-decoration: none ">
            <figure >
                <img src="{{URL::asset('/images/profile/'.App\Models\User::where('id',$key->author_id)->get()->value('photo'))}}" width="250px" height="250px" style="border-radius: 130px" />
                <figcaption class="text-center mt-4  ">
                     <h4 style="color: slategray">  {{App\Models\User::where('id',$key->author_id)->get()->value('name')}}  </h4>
                 </figcaption>
                </figure>
        </a>
    </div>
       @endif
       @endforeach
    @endforeach
  
    </div>
    <div class="display-block text-end mt-4 mb-4">
    <a href="/allauthors" style="text-decoration: none;color:rgb(106, 102, 102);"> See all</a>
    </div>
    </div>
    <hr style="width: 90%;margin-left:60px" class="mb-4">
    
<div class="mt-4">
    <br><br><br>
@include('user.subscription')

</div>
</body>
</html>
@endsection
