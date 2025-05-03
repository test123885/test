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
    <script src="{{URL::asset('/js/jquery-3.3.1.min.js')}}"></script> 

    <title>Canceld Orders</title> 
</head>
<body style="overflow-x:hidden">
<br>

<p  style="text-align: center">
    <a href="/order" role="button" class="btn btn-primary mt-4 me-4 ms-4 "  > All Orders</a>
    <a href="/pendingorders" role="button" class="btn btn-primary mt-4 me-4  "  > Pendining Orders</a>
    <a href="/canceldorders" role="button" class="btn btn-primary mt-4 me-4  "  > Canceld Order</a>
    <a href="/deleverdorders"role="button" class="btn btn-primary mt-4  "  > Deleverd Order</a>
    
  </p>  
   <center>
<br>
 {{-- <h1 style="color: white">Orders</h1> --}}
    <div class="product-status mg-b-30    " style="margin-left:  5%;margin-top: 50px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 ">

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
                                <th  class="col-3">Name</th>
                                <th  class="col-2">Email</th>
                                <th  class="col-2">Phone </th>
                                <th  class="col-3">Adress</th>
                                <th  class="col-1">Orders</th>
                                 <th  class="col-1">Pay Method</th>
                                <th  class="col-1">Book Type</th>

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
                                     <a href="/orderdetails/{{$key->checkout_id}}" role="button" class="btn btn-primary   "  id="orderdata"> Order</a>
                                </td>
                                 <td>
                                  {{App\Models\Checkout::where('id',$key->checkout_id)->get()->value('method')}} 

                                  </td> 
                                   <td>
                                    {{App\Models\Checkout::where('id',$key->checkout_id)->get()->value('booktype')}} 
  
                                    </td>
                                @endif
                                @endforeach
                            </tr>
                          
                            
                            
                            
                            @empty
                            <h1 style="color: black"> You Don`t have Canceld Orders </h1>
    
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