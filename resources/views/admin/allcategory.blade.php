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

    <title>Category</title>
</head>
<body  style="overflow-x:hidden">
    
<p  style="text-align: center ">
  <br>
  <br>
  <span class="me-3  h1 pt-4" style="color: #CC5B23">count : 
    @if(!(App\Models\Category::get())->isEmpty())
    {{App\Models\Category::get()->count()}}
  
   @else
     0
 
 @endif    
</span>
   <button type="button" class="btn btn-primary ms-4  " data-bs-toggle="modal" data-bs-target="#exampleModal"  > + Add Category</button>
  
</p>    

 
@if(Session::has('success'))
<div class="alert alert-success alert-dismissible" role="alert" style="background-color: #0e3554;color:azure;margin-bottom: -20px;margin-left:10%; width:56%; margin-top:50px;font-weight:bolder;text-align:center;" >
  {{Session::get('success')}}
  <button type="button" class="btn-close text-light" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<br>
   <center>

 
    <div class="product-status mg-b-30    " style="margin-left: 5%;margin-top: 50px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-10 col-sm-10 col-xs-10">

                    <div class="product-status-wrap">
                        
                        <table>
                                
                            
                            @if (!$data->isEmpty())

                            <tr>  <th class="col-2" >#</th>
                                <th class="col-6" > Category Name</th>
                                <th  class="col-4">Delete  </th>
                            
                                

                            </tr>
                            @endif

                            @forelse($data as $item)
                            <tr><td>{{$loop->iteration}}</td>
                             

                                <td >{{$item->catname}}</td>
                                <td>
                                    <form method="POST" action="/category/{{$item->id}}">
                                        @method('DELETE')
                                        @csrf
                                        <a href="/category/{{$item->id}}" title="delete category"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();"><i class="bi bi-trash3 h4 text-danger"></i></a>&nbsp;
                                     </form>


                                </td>
                                
                                 
                                     
                                   
                            </tr>
                        
                                
                            @empty
                                <h1 style="color: rgb(164, 202, 236)"> No Category </h1>
                            @endforelse
                        </table>
                    </div>    
                      
                    
                </div>
            </div>
        </div>
    </div>
</center>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form  action="/category" method="POST" >
          @csrf
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Category Name :</label>
            <input type="text" class="form-control" id="recipient-name" name="catname">
          </div>
        
        
      </div>
      <div class="modal-footer">
         <button type="submit" class="btn btn-primary">ADD</button>
      </div>
    </form>
    </div>
  </div>
</div>






</body>
</html>
@endsection
@endcan