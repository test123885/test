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

    <title>Contacts</title>
</head>
<body 

>
   <center>

    <br>
    <h1 style="color: #CC5B23;">Contacts List <span class="ms-3">&nbsp;&nbsp;&nbsp;&nbsp;count: 
        @if(!(App\Models\Contacts::get())->isEmpty())
        {{App\Models\Contacts::get()->count()}}
      
       @else
         0
     
     @endif    
    </span></h1>
 
 
    <div class="product-status mg-b-30    " style="margin-left:  5%;margin-top: 50px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-lg-12 ">

                    <div class="product-status-wrap">
                        
                        <table  table style="
                    height: 500px; 
                    display:flexbox;
                    overflow-y: scroll ;
                    scrollbar-width: thin ;
                     scrollbar-color: #4B5563 #E5E7EB;
                      

                      ">
                                
                            
                            @if (!$data->isEmpty())

                            <tr><th class="col-1">#</th>
                                <th class="col-2" >Name</th>
                                <th  class="col-3">Email  </th>
                                <th class="col-3" >Phone Number</th>
                                <th class="col-3" >Message  </th>
                                

                            </tr>
                            @endif

                            @forelse($data as $item)
                            <tr><td>{{$loop->iteration}}</td>
                                <td >{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td >{{$item->phone}}</td>
                                <td>{{$item->message}}</td>
                                
                                 
                                     
                                   
                            </tr>
                        
                                
                            @empty
                                <h1 style="color: black;"> No Messages </h1>
                            @endforelse
                        </table>
                    </div>    
                      
                    
                </div> 
            </div>
        </div>
    </div>
</center>
</body>
</html>
@endsection
@endcan