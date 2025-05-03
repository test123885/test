@can("isAdmin")
@extends('admin.nav')
@section('mynav')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
 
    <title>Notifications</title>
</head>
<body >
    {{-- {{auth()->user()->Notifications}} --}}
    @forelse(auth()->user()->Notifications as $notification)
        @if (isset($notification->data['book_id']))
            <div >
                <a class="dropdown-item" href="/book/{{$notification->data['book_id']}}" style="text-decoration: none;color:#0f558e"> 
                    
                    
      <h4>   <br>  {{$notification->data['user_create']}} {{$notification->data['tiltle']}}        <br></h4> 
                    
                    
                    <br>  <span class="text-bold text-dark">At</span> {{$notification->created_at}} <br>

                    ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___</a>
                 

            </div>
        @elseif (isset($notification->data['request_book']))
        <div  >
           <a class="dropdown-item" href="/bookrequest" style="text-decoration: none;color:#3e5a71"> 
                
      <h4>   <br>   {{$notification->data['tiltle']}}        <br></h4> 
                    
                    
      <br>  <span class="text-bold text-dark">At</span> {{$notification->created_at}} <br>

      ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___</a>

   

        
        </div> 
        @else
        <div >
            <a class="dropdown-item" href="/pendingorders" style="text-decoration: none;color:#4a6174">
            
                    
      <h4>   <br>    {{$notification->data['tiltle']}}        <br></h4> 
                    
                    
      <br>  <span class="text-bold text-dark">At</span>  {{$notification->created_at}} <br>

      ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___ ___</a>

   

             

        </div>
        @endif
    @empty
        <h1>You Don`t Have any Notification</h1>
    @endforelse
</body>
</html>
@endsection
@endcan