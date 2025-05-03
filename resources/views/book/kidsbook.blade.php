@extends('auther.nav')
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
 
<div  class="container mt-3 mb-4">
    <center class="mb-4 h1" > Kids Books</center>
    <div class="row">
  
  @foreach ($data as $item)
      
     <div class=" col-3  test mt-4">
        <a href="/details/{{$item->id}}" style="text-decoration: none">
         <figure >
             <img src="{{URL::asset('/images/books/'.$item->photo)}}" width="250px" height="250px" />
             <figcaption class="text-center mt-1  ">
                 <h4  style="color: steelblue">{{$item->bookname}}</h4>
                 <h4 style="color: slategray">{{App\Models\User::where('id',$item->author_id)->get()->value('name')}}</h4>
                 <h4 style="color: slategrey">EGP {{$item->price}} </h4>
             </figcaption>
             </figure>
        </a>
     </div>
  @endforeach
    </div>
 
    </div>
   


    <div class="mt-4">
        <br><br><br>
    @include('user.subscription')
    
    </div>
</body>
</html>
@endsection