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
 
 
    <title> Pending Orders</title>
</head>
<body  
style="background-color: rgb(239, 238, 238);overflow-x: hidden"
>
 
<br>
 
<div class="product-status mg-b-30    " style="margin-left: 2%;margin-top: 50px">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 ps-3">

                <div class="product-status-wrap">
                    
                    <table style="
                    height: 500px; 
                    display: inline-block;
                    overflow-y: scroll ;
                    scrollbar-width: thin ;
                     scrollbar-color: #4B5563 #E5E7EB;

                  ">
                            
                        
                     
@if (!$data->isEmpty())

                        <tr>
                            <th  class="col-2">Name</th>
                            <th  class="col-2">Email</th>
                            <th  class="col-2">Phone </th>
                            <th  class="col-3">Adress</th>
                            <th  class="col-2">Nots</th>
                            <th  class="col-1">Orders</th>
                           
                            

                        </tr>
                        @endif
                        @forelse ($data as $item )
                        
                        <tr>
                          @foreach ($item as $key)

                          @if ($loop->first)
                          
                         
                            <td >
                         
                               
                              {{App\Models\Checkout::where('id',$key->checkout_id)->get()->value('name')}}
                            </td>
                            <td>
                              {{App\Models\Checkout::where('id',$key->checkout_id)->get()->value('email')}}
                              
                            </td>
                            <td >
                              {{App\Models\Checkout::where('id',$key->checkout_id)->get()->value('phone')}}
                              
                            </td>
                            <td >
                              {{App\Models\Checkout::where('id',$key->checkout_id)->get()->value('stat')}} ,
                              {{App\Models\Checkout::where('id',$key->checkout_id)->get()->value('city')}} ,
                              {{App\Models\Checkout::where('id',$key->checkout_id)->get()->value('streetnumber')}}
                              
                            </td>
                            <td >                             
                            {{App\Models\Checkout::where('id',$key->checkout_id)->get()->value('notes')}}
                            </td>

                            <td > 
                                 <a href="/orderdetails/{{$key->checkout_id}}" role="button" class="btn btn-primary   "  id="orderdata"> Order</a>
                            </td>
                            
                            @endif
                            @endforeach
                        </tr>
                      
                        
                        
                        
                        @empty
                        <h1 style="color: black"> You Don`t have Pending Orders </h1>

@endforelse
                    </table>
                </div>    
                  
                
            </div>
        </div>
    </div>
</div>
    

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
@endsection
