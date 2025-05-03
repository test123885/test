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

    <title>all Users</title>
</head>
<body 


>
 
   <center>

<br>
 <h1 style="color: #CC5B23">
    <a href="/user" role="button" class="btn btn-primary mt-4 me-4 ms-4 "  > All Users</a>
    <a href="/authors" role="button" class="btn btn-primary mt-4 me-4  "  > Authors</a>
    <a href="/users" role="button" class="btn btn-primary mt-4 me-4  "  > Users</a>
     
    <span class="   ">&nbsp;&nbsp;&nbsp;&nbsp;count: 
        @if(!(App\Models\User::where('role','user')->get())->isEmpty())
        {{App\Models\User::where('role','user')->get()->count()}}
      
       @else
         0
     
     @endif    
    </span> 
 </h1>  
     
 @if(Session::has('success'))
 <div class="alert alert-success alert-dismissible" role="alert" style="background-color: #0e3554;color:azure;margin-bottom: -20px; width:56%; margin-top:50px;font-weight:bolder;text-align:center;" >
   {{Session::get('success')}}
   <button type="button" class="btn-close text-light" data-bs-dismiss="alert" aria-label="Close"></button>
 </div> 
 @endif
 <br>
    <div class="product-status mg-b-30    " style="margin-left: 5%;margin-top: 50px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 ">

                    <div class="product-status-wrap">
                        
                        <table table style="
                    height: 500px; 
                    display:flexbox;
                    overflow-y: scroll ;
                    scrollbar-width: thin ;
                     scrollbar-color: #4B5563 #E5E7EB;">
                                
                            
                            @if (!$data->isEmpty())

                            <tr><th  class="col-1">#</th>
                                <th  class="col-2">Name</th>
                                <th  class="col-3">Email</th>
                                
                                <th  class="col-2">Block</th>
                                 
                                

                            </tr>
                            @endif

                            @forelse($data as $item)
                            <tr><td>{{$loop->iteration}}</td>
                             

                                <td >{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                 
                                <td><a href="/blockuser/{{$item->id}}" title="block user">
                                    @if (App\Models\Block::where("user_id",$item->id)->first())
                                    <i class="bi bi-ban h4 text-danger"></i>
                                       
                                           
                                       @else
                                    <i class="bi bi-ban h4 text-black"></i>
                                           
                                        
                                    @endif
                                
                                </a>
                            
                            </td>
                                 
                                 
                                     
                                   
                            </tr>
                        
                                
                            @empty
                                <h1 style="color: black"> No Users </h1>
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