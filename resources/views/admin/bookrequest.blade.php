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

    <title>Book Request</title>
</head>
<body >
   <center>
    <br>
    <h1 style="color:  #CC5B23">Book Request

        <span class="ms-3  ">&nbsp;&nbsp; count: 
            @if(!(App\Models\Book::where('statuse','pending')->get())->isEmpty())
            {{App\Models\Book::where('statuse','pending')->get()->count()}}
                                                             
           @else
             0
         
         @endif    
        </span>
    </h1>

    @if(Session::has('success'))
<div class="alert alert-success alert-dismissible" role="alert" style="background-color: #0e3554;color:azure;margin-bottom: -20px;margin-left:10%; width:56%; margin-top:50px;font-weight:bolder;text-align:center;" >
  {{Session::get('success')}}
  <button type="button" class="btn-close text-light" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
 
    <div class="product-status mg-b-30    " style="margin-top: 50px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="product-status-wrap">
                        
                        <table style=" height: 600px; 
                            display:inline-block;
                            overflow-y: scroll ;
                             scrollbar-width: thin ;
                             scrollbar-color: #4B5563 #E5E7EB;"  >
                                
                            
                            @if (!$data->isEmpty())

                            <tr>
                                <th  class="col-2">Auther Name </th>
                                <th  class="col-2">Book Name</th>
                                <th  class="col-3">Description</th>
                                <th  class="col-1">Price </th>
                                <th  class="col-2">photo  </th>
                                <th  class="col-2">Modify  </th>
                                

                            </tr>
                            @endif

                            @forelse($data as $item)
                            <tr>
                             

                                <td >{{App\Models\User::where('id',$item->author_id)->value('name')}}</td>
                                <td>{{$item->bookname}}</td>
                                <td >{{$item->details}}</td>
                                <td>{{$item->price}}</td>
                                <td> <img src="{{URL::asset('/images/books/'.$item->photo)}}" width="100px" height="50px"></td>
                                <td>
                                    <form method="POST" action="/book/{{$item->id}}">
                                        @method('DELETE')
                                        @csrf 
                                        <a href="/book/{{$item->id}}" title="delete book"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();"><i class="bi bi-trash3 h4 text-danger"></i></a>&nbsp;
                                        <a href="/acceptbook/{{$item->id}}" title="add book to main book"><i class="bi bi-plus h4"></i></a>
                                    </form>
                                </td>                                
                                 
                                     
                                   
                            </tr>
                        
                                
                            @empty
                                <h1 style="color: black"> No Book Request </h1>
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