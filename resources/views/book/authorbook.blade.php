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
 
  
  <section class="book-section">
    @forelse ($data as $item)
 

          <div class="book-card border border-dark  position-relative">
            @if (App\Models\Offer::where('book_id',$item->id)->get()->first() !=null)
          <div class="position-absolute top-0 start-0">
  <img src="{{URL::asset('/images/ddddPNG-removebg-preview.png')}}" alt="blue square" width="60px" height="60px"/>   
          
          </div>
          @endif
           <p>
            <figure >
                <a href="/details/{{$item->id}}" style="text-decoration: none">

                <img src="{{URL::asset('/images/books/'.$item->photo)}}" width="50px" height="150px" />

                   </a>
              
                  <figcaption class="text-center    ">
                    <h4  style="color: black;height:100px">{{$item->bookname}}</h4><br>
                 <h4 style="color: slategray;height:50px">{{App\Models\User::where('id',$item->author_id)->get()->value('name')}}</h4>
                 <h4 style="color: slategrey">           
                           @if (App\Models\Offer::where('book_id',$item->id)->get()->first() !=null)

                
EGP{{App\Models\Offer::where('book_id',$item->id)->get()->value('offer')}}
@else
EGP  {{$item->price}} 
@endif </h4>
                     <h4> 
                       
     @if (Auth::check())

      
@if (!(App\Models\Favorat::where([['book_id',$item->id],['user_id',auth()->user()->id]])->get())->isEmpty())
           

<form action="/favorat" method="POST"  style="display: inline" >
 @csrf
 <input type="hidden" name="book_id" value="{{$item->id}}" style="display: inline">
 
  <button type="submit" class="btn btn-outline-danger  border-0"  style="display: inline"  ><i class="bi bi-suit-heart-fill h4"></i> </button>
</form>




     
@else
<form action="/favorat" method="POST" style="display: inline" >
 @csrf
      <input type="hidden" name="book_id" value="{{$item->id}}" style="display: inline">

  <button type="submit" class="btn btn-outline " style="display: inline"  ><i class="bi bi-suit-heart-fill h4"></i> </button>
</form>
     
@endif
@else
<form action="/favorat" method="POST" style="display: inline" >
@csrf
   <input type="hidden" name="book_id" value="{{$item->id}}" style="display: inline">

<button type="submit" class="btn btn-outline " style="display: inline"  ><i class="bi bi-suit-heart-fill h4"></i> </button>
</form>

@endif

                        


                        </h4>
                 </figcaption>
                 </figure>
            
            </p>
        </div>

      @empty
          <h1 style="color: rgb(108, 180, 244)"> No  Books </h1>
          
      @endforelse
  </section>


 
        
        <div class="mt-4">
            <br><br><br>
        @include('user.subscription')
        
        </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
@endsection