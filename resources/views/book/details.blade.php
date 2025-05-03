@extends('nav')
@section('mynav')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
  @if(Session::has('success'))
    

  <script>
    var config = <?php echo json_encode(Session::get('success')); ?>;
      function showSweetAlert() {
          Swal.fire({
              title: '',
              text: config ,
              icon: 'success',
              confirmButtonText: 'OK'
          });
      }
      showSweetAlert();
  </script>
        
  @endif
 
<div class="container  ps-4 " style="margin-top: 50px">
    <br><br><br>

<div class="row  ">
<div class="col-10 col-lg-5 mt-4 mb-4 me-1">
    <img src="{{URL::asset('/images/books/'.$data->photo)}}" width="400px" height="400px"  class="shadow-lg"/>

    <br>
    <br>
    <div  class="col-12"  style="  display:inline-block;border-radius: 5px ">
      @foreach (App\Models\Review::where('book_id',$data->id)->get() as $item)
    
    <div style=" display:inline-block;background-color:white;border-radius: 5px " class="mt-3  p-1 mb-3 col-12" >
    
      <div class="card">
        <div class="card-header" style="background-color: #0038a8;color:white;">
          {{App\Models\User::where('id',$item->user_id)->first()->name }}
        </div>
        <div class="card-body">
           
           
          <h5 class="card-title">{{$item['review']}}</h5>
       
        </div>
      </div>
    </div>
    @endforeach
    </div>
    <div class="col-12 mt-4">
    
    <form action="/review" method="POST" >
        @csrf
        <input type="hidden" name="book_id" value="{{$data->id}}">
        <input type="hidden" name="author_id" value="{{$data->author_id}}">
        <div class="form-floating">
            <textarea class="form-control "  name="review" id="floatingTextarea" required></textarea>
            <label for="floatingTextarea">Add Review</label>
          </div>
         <button type="submit" class="btn   mt-2" style="background-color: #0038a8;color:white;">   Review</button>
    <button type="button" class="btn btn-outline-primary mt-2 ms-4" data-bs-toggle="modal" data-bs-target="#rateModal" data-bs-whatever="@mdo"> Rate<i class="bi bi-star" onkeydown="return false"></i></button>

    </form>
    
    </div>
</div>    
<div class="col-10 col-lg-5 mt-4 ms-1">
    <h1  style="color: #0038a8">{{$data->bookname}} 
    
     @if (Auth::check())

      
    @if (!(App\Models\Favorat::where([['book_id',$data->id],['user_id',auth()->user()->id]])->get())->isEmpty())
               

    <form action="/favorat" method="POST"  style="display: inline" >
     @csrf
     <input type="hidden" name="book_id" value="{{$data->id}}" style="display: inline">
     
      <button type="submit" class="btn btn-outline-danger  border-0"  style="display: inline"  ><i class="bi bi-suit-heart-fill h4"></i> </button>
 </form>




         
    @else
    <form action="/favorat" method="POST" style="display: inline" >
     @csrf
          <input type="hidden" name="book_id" value="{{$data->id}}" style="display: inline">

      <button type="submit" class="btn btn-outline " style="display: inline"  ><i class="bi bi-suit-heart-fill h4"></i> </button>
 </form>
         
    @endif
@else
<form action="/favorat" method="POST" style="display: inline" >
  @csrf
       <input type="hidden" name="book_id" value="{{$data->id}}" style="display: inline">

   <button type="submit" class="btn btn-outline " style="display: inline"  ><i class="bi bi-suit-heart-fill h4"></i> </button>
</form>

  @endif

    
    <br><br>
        <p style="display:inline-block;color:red"  >
 
            @forelse (App\Models\Rate::where('book_id',$data->id)->get()->groupBy('book_id')  as $item)
                  
             {{ROUND($item->AVG('rate'), 2)}} <i class="bi bi-star-half"></i><i class="bi bi-star-half"></i><i class="bi bi-star-half"></i><i class="bi bi-star-half"></i><i class="bi bi-star-half"></i>
            @empty
              0 <i class="bi bi-star"></i><i class="bi bi-star"></i><i class="bi bi-star"></i><i class="bi bi-star"></i><i class="bi bi-star"></i>
            @endforelse
             
            </p>
          </span>     

    </h1><br>
            <h4 style="color: slategray">{{$data->details}}</h4><br>
            <h4 > Author :  {{App\Models\User::where('id',$data->author_id)->get()->value('name')}} </h4>
            <h4 > 
              @if (App\Models\Offer::where('book_id',$data->id)->get()->first() !=null)

                
                Price :  <span class="text-decoration-line-through " style="color: slategrey">EGP{{$data->price}}</span> <br>
                Offer :EGP{{App\Models\Offer::where('book_id',$data->id)->get()->value('offer')}}
            @else
               Price : EGP  {{$data->price}}
            @endif
            
             </h4><br> 
               <form action="/cart" method="POST" >
            @csrf
            <input type="hidden" name="book_id" value={{$data->id}}>
            <input type="number" min="1" class="col-2  p-2" style="height: 40px" value="1" name="quantaty">
             <button  class="btn  p-2 w-50 " type="submit"  id=""    role="button" style="background-color: #2796AD" > &nbsp;&nbsp;&nbsp;&nbsp; Add To  Cart &nbsp; <i class="bi bi-arrow-right"></i> &nbsp;&nbsp;&nbsp;&nbsp;</a>
            
              </form>
</div> 
</div>
</div>
<div  >
    <br><br><br>
    <br><br><br>
    <br><br><br>
    @include('user.subscription')


    <div class="modal fade" id="rateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #0038a8;color:white;">
              <h5 class="modal-title" id="exampleModalLabel">Add  Rate </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/rate" method="POST" >
              @csrf
            <div class="modal-body">
            
                <input type="hidden" name="book_id" value="{{$data->id}}">
                <input type="hidden" name="author_id" value="{{$data->author_id}}">
                
                <div class="mb-3">
                   <input type="number" name="rate" min="1" max="5" class="form-control"   />
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary "> ADD</button>
            </div>
          </form>
      
          </div>
        </div>
      </div>
      
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>

@endsection