@extends('admin.nav')
@section('mynav')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>show book details</title>
    <script src="{{URL::asset('/js/jquery-3.3.1.min.js')}}"></script> 

</head>
<body  style="overflow-x:hidden">
    <br>
    <br>
   <div class="container mt-2">
    <div class="row">
        <div class="col-10 col-md-6 ">
<img src="{{URL::asset('/images/books/'.$data->photo)}}" alt="" width="300px" height="300px">
<br><br>
<div class="h4 mt-4" style="color: #2796AD"> Name : <span style="color: #464f51" >{{$data->bookname}}</span>  </div>
<div class="h4" style="color: #2796AD">  Category : <span style="color: #464f51" >{{App\Models\Category::where('id',$data->cat_id)->get()->value('catname')}}</span>  </div>
<div class="h4" style="color: #2796AD">  Auther : <span style="color: #464f51" >{{App\Models\User::where('id',$data->author_id)->get()->value('name')}}</span>  </div>
<div class="h4" style="color: #2796AD">  Statuse : <span style="color: #464f51" >{{$data->statuse}}</span>  </div>
<div class="h4" style="color: #2796AD">  Price : <span style="color: #464f51" >{{$data->price}} EGP</span>   </div>
<div class="h4" style="color: #2796AD">  Rate : <span style="color: #464f51" >
    @forelse (App\Models\Rate::where('book_id',$data->id)->get()->groupBy('book_id')  as $item)
                  
    {{ROUND($item->AVG('rate'), 2)}} <i class="bi bi-star-half text-danger"></i>
   @empty
     0 <i class="bi bi-star text-danger"></i>
   @endforelse


</span>   </div>


@if ($data->pdf !=null)
<div class="h4" style="color: #2796AD">Book PDF : <span style="color: #464f51" >
<a href="/openpdf/{{$data->pdf}}" title="open pdf" >{{$data->pdf}}</a></span>  </div>
@endif

<div class="h4" style="color: #2796AD">  
    
    @foreach (App\Models\Review::where('book_id',$data->id)->get() as $item)
    
    <div style=" display:inline-block;border-radius: 5px " class="mt-1  p-1 mb-1 col-12" >
    
      <div class="card">
        <div class="card-header" style="background-color: #2796AD;color:white;">
          {{App\Models\User::where('id',$item->user_id)->first()->name }}
        </div>
        <div class="card-body">
           
           
          <h5 class="card-title">{{$item['review']}}</h5>
       
        </div>
      </div>
    </div>
    @endforeach

</div>



        </div>
       <div class="col-10 col-md-6">

<div class="h4" style="color: #2796AD">Book Details : <br><span style="color: #464f51" >{{$data->details}}</span>  </div>
<div class="h4 mt-3" style="color: #2796AD">Update Statuse : <span style="color: #464f51;"   >
 
    <select class="form-select ms-4 mt-4   statuse" aria-label="Default select example" name="statuse" id="{{$data->id}}">
        <option selected value="{{$data->statuse}}">{{$data->statuse}}</option>
        <option value="published">published</option>
        <option value="canceld">canceld</option>
        <option value="pending">pending</option>
      </select>
 
    
    
     </span>  </div>
 
        </div>

    </div>
</div>

   







   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>


   <script type="text/javascript">
    $(document).ready(function() {   
    $(".statuse").on("change", function(){
              var id = $(this).attr("id");
            var sta = $(this).val();

            // console.log(sta);
            $.ajax({

                url: '/updatebookstatuse/'+id ,
                type: 'GET',
                dataType: 'json',
                data:{'status': sta}, 
                success: function(response) {
                     
                window.alert('Book is  ' + response.message);

                window.location.reload();


                 },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>
</body>
</html>
@endsection