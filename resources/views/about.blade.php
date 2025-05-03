 
 @extends('nav')
 @section('mynav')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>about us</title>
    
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    --}}

     <style>
      @media (width < 980px) {
        .aboutimage{
          display: none
        }
     
}
      </style> 
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
<br>
 <section>
 

  <div class="container">
    <div class="row col-12 ms-4">
      <h1>Welcome to Kalamah Waharf</h1>
        <p class="mt-4 ms-4" >
         
          The electronic library  aims to create a comprehensive 
          digital platform offering a wide variety of books across different fields, 
          catering to readers who speak both Arabic and English. The library will include books 
           in  literature,  science,  technology,  history,  philosophy , 
            self-development , and other areas to meet diverse interests.
          <br>
          <br>
        </p>
        <h1>Our Mession</h1>
        <p class="mt-4 ms-4" >
          Kalamah Waharf become the best website in the world
        </p>
      </div>
        
  </div>

 
</section>   
 


<br><br><br><br>
<div>
  @include('user.subscription')

</div>
   

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@floating-ui/core@1.6.8"></script>
<script src="https://cdn.jsdelivr.net/npm/@floating-ui/dom@1.6.12"></script>
 
</body>
</html>
 @endsection
 