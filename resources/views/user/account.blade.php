@extends('nav')
@section('mynav')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
      .acc :hover{
background-color: rgb(248, 234, 234)
      }
    </style>
</head>
<body>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-2 g-4 mt-2">
          <div class="col acc">
            <div class="card">
              
              <div class="card-body">
                <h5 class="card-title">
                  
                  <a type="button" class="dropdown-item asd"  href="order"  >
<img src="{{URL::asset('/images/order.jpg')}}" alt="blue square" style="height: 50px;width:50px;display:inline; border-radius: 50%;"/>   
                  
                  
                  My Order</a>   </h5>
                <p class="card-text">
                 
                  
follow your order syatuse ...             
 </div>
            </div>
          </div>
          <div class="col acc">
            <div class="card">
              
              <div class="card-body">
                <h5 class="card-title">
                  
                  <a type="button" class="dropdown-item asd"  href="/cart"  >
<img src="{{URL::asset('/images/cart.jpg')}}" alt="blue square" style="height: 50px;width:50px;display:inline; border-radius: 50%;"/>   
                  
                  
                  My Cart</a>   </h5>
                <p class="card-text">
                 
                  
you can see your cart . delete book . clear cart ...             
 </div>
            </div>
          </div>
          <div class="col acc">
            <div class="card">
              
              <div class="card-body">
                <h5 class="card-title">
                  
                  <a type="button" class="dropdown-item asd"  href="/favorat"  >
<img src="{{URL::asset('/images/41892304.jpg')}}" alt="blue square" style="height: 50px;width:50px;display:inline; border-radius: 50%;"/>   
                  
                  
                  My Wishlist </a>   </h5>
                <p class="card-text">
                 
                  
show Your Wishlist ...             
 </div>
            </div>
          </div>
            <div class="col acc">
              <div class="card">
                
                <div class="card-body">
                  <h5 class="card-title">
                    
                    <a type="button" class="dropdown-item asd"  href="/user/profile"  >
  <img src="{{URL::asset('/images/profile/77.jpg')}}" alt="blue square" style="height: 50px;width:50px;display:inline; border-radius: 50%;"/>   
                    
                    
                    My Profile</a>   </h5>
                  <p class="card-text">
                   
                    
 show and update Your profile ,delete account ...             
   </div>
              </div>
            </div>
          </div>


    <div class="row row-cols-1 row-cols-md-2 g-4 mt-1">
      <div class="col acc">
        <div class="card">
          
          <div class="card-body">
            <h5 class="card-title">
              
              <a type="button" class="dropdown-item asd"  href="userbooks"  >
<img src="{{URL::asset('/images/6c0.png')}}" alt="blue square" style="height: 50px;width:50px;display:inline; border-radius: 50%;"/>   
              
              
              My Books </a>   </h5>
            <p class="card-text">
             
              
show Your book pdf ...             
</div>
        </div>
      </div>
        <div class="col">
          <div class="col acc">
            <div class="card">
              
              <div class="card-body">
                <h5 class="card-title">
                  
                  <a type="button" class="dropdown-item asd"  href="/notification"  >
    <img src="{{URL::asset('/images/2WTCK2E.jpg')}}" alt="blue square" style="height: 50px;width:50px;display:inline; border-radius: 50%;"/>   
                  
                  
                  My Notification </a>   </h5>
                <p class="card-text">
                 
                  
    show Your notification ...             
    </div>
            </div>
          </div>
         
        
      </div>
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
