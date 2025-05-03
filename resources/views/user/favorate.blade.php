@extends('nav')
@section('mynav')
<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <title>Favorite</title>
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
<div class="row col-12 mt-4" style="margin-top: 50px;margin-left:5%">

@if (!($data)->isEmpty())
    
<div class="row featured__filter ms-1">
@foreach ($data as $items)



@foreach (App\Models\Book::where('id',$items->book_id)->get() as $item)
    
<div class="card ms-2 mt-3" style="width: 18rem;">
     <img src="{{URL::asset('/images/books/'.$item->photo)}}" class="card-img-top mt-2" alt="..." height="200px" width="100px" height="200px">
        
     
    <div class="card-body">
        <h5 class="card-title" style="height: 150px">{{$item->bookname}}   </h5>
      
        
        <a href="/details/{{$item->id}}" class="btn btn-primary mb-3" style="margin-bottom: 2px">Details</a>
      </div>
  </div>




@endforeach


@endforeach


</div>



@else
<div style="text-align: center;margin-top:100px">
    <h1 style="color: rgb(12, 59, 100)" > You don`t have any Favorite books </h1>
  </div> 
@endif

</div>
<div class="mt-4">
  <br><br><br>
@include('user.subscription')

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>

@endsection