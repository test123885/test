@extends('nav')
@section('mynav')
<!DOCTYPE html>
<html>
<head>
	<title>Contact us</title>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="{{URL::asset('/css/contact.css')}}">
 <style>

 
.left{
    background-size:500px 600px;
	height: 100%;
    border-radius: 30px;
    background-image: url({{URL::asset('/images/ebook4.jpg')}}) ;

    	
}
</style>
</head>
<body style="">

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
   <br><br> <br>

   <section>
 

    <div class="container">
      <div class="row col-12 ms-4">
        <h1>Contact Information</h1>
        <p class="mt-4 ms-4">
            We will answer any questions you may have about our online sales, rights, or partnership service right here.

            <br>
            <br>
          </p>
          <h1>Get In Touch</h1>
          <div class="mt-4 ms-4" >
            <form  method="POST" action="/contacts"   class="row g-3  ">
                @csrf


                <div class="col-md-5">
                    <label for="validationCustom01" class="form-label">Your Name <span style="color: red">*</span></label>
                    <input type="text" class="form-control" id="validationCustom01" name="name"  required>
                     
                  </div>
                  <div class="col-md-5">
                    <label for="validationCustom02" class="form-label">Email <span style="color: red">*</span></label>
                    <input type="email" class="form-control" id="validationCustom02"  name="email" required>
                    
                 
                </div>
                
                  
                 <div class="col-md-5">
                    <label for="validationCustom01" class="form-label">Your Message <span style="color: red">*</span></label>
                    <textarea  class="form-control" name="message" required rows="3"></textarea>
                     
                  </div>
                  <div class="col-md-5">
                    <label for="validationCustom01" class="form-label">Phone <span style="color: red">*</span></label>
                    <input type="text" class="form-control" id="validationCustom01" name="phone"  required>
                     
                  </div>
                 <br>
                <input type="submit" value="Message Us" class="bt mt-3"><br><br>
            </form>
        </div>
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
