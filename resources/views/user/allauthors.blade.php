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
 
    <div  class="container mt-3 mb-4">
        <center class="mb-4 h1 text-light" > All Authors</center>
        <div class="row" style="margin-top: 50px ">
    @foreach ($data as $item)
        
        <div class="  col-sm-5 col-lg-3   mt-4 me-2" >
            <a href="/authorbook/{{$item->id}}" style="text-decoration: none ">
                <figure >
                    <img src="{{URL::asset('/images/profile/'.$item->photo)}}" width="250px" height="250px" style="border-radius: 130px" class="imageauthor" />
                    <figcaption class=" mt-4  ms-4 ">
                         <h4 style="color: slategray"> 
                            
                            {{substr($item->name,0,12)}}
                        </h4>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
@endsection