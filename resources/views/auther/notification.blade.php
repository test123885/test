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

 
    <title> Notification</title>
</head>
<body  
style="background-color: rgb(239, 238, 238);overflow-x: hidden"
>
<div class=" " style="margin-left:10%;margin-top: 50px">
    <div class="row">

    @forelse(auth()->user()->Notifications as $notification)
@if (isset($notification->data['book_id']))
    <div >
        <a class="dropdown-item" href="/details/{{$notification->data['book_id']}}" style="text-decoration: none;color:#0f558e"> 
            
            
<h4>   <br>  {{$notification->data['user_create']}} {{$notification->data['tiltle']}}        <br></h4> 
            
            
            <br>  <span class="text-bold text-dark">At</span> {{$notification->created_at}} <br>

            ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ </a>
         

    </div>
@elseif (isset($notification->data['checout_id']))
<div  >
   {{-- <a class="dropdown-item" href="/pendingorders" style="text-decoration: none;color:#3e5a71">  --}}
        
<h4>   <br>   {{$notification->data['tiltle']}}        <br></h4> 
            
            
<br>  <span class="text-bold text-dark">At</span> {{$notification->created_at}} <br>

___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ 
{{-- </a> --}}




</div> 
@elseif (isset($notification->data['blocked']))
<div  class="dropdown-item" >
         
<h4>   <br>  {{$notification->data['user_create']}}  {{$notification->data['blocked']}}        <br></h4> 
            
            
<br>  <span class="text-bold text-dark">At</span> {{$notification->created_at}} <br>

___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ 




</div> 
       @endif
@empty
<h1 class="text-danger text-left mt-4 " style="margin-left: -50px" >
    You Don`t Have any Notification</h1>
@endforelse

</div>
</div>
 
 
 



 

    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
@endsection
