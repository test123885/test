<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css"
    rel="stylesheet"
  />
  <link rel="stylesheet" href=" {{ URL::asset('css/style.css') }} " >
  <script src="{{URL::asset('/js/jquery-3.3.1.min.js')}}"></script> 
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
  
</style>
    <title>Document</title>
</head>
<body style="overflow-x: hidden ">
    <header class="header" id="home">
      <nav class="navbar navbar-expand-lg  ">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">
            
            <img src="{{URL::asset('/images/download-removebg-preview.png')}}"  style="width:130px;height: 130px;display: inline;"> 
            
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation" id="menu-btn">
            <span class="navbar-toggler-icon"  ></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav nav__links"  id="nav-links" >
              <li ><a href="/" >Home</a></li>
             
              <li class=" dropdown">
                <a class=" dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Menu
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  @if (Auth::check())
                  <li><a class="dropdown-item" href="/notification">Notification
                    @if (auth()->user()->unreadNotifications->count() > 0)
                    <span class="right text-bold"><i class="bi bi-dot    h2 text-success text-bold"></i></span>
                    @endif
                  </a></li>
                  @endif
                  <li><a class="dropdown-item" href="/offer">Offers</a></li>
                  
                 </ul>
              </li>
              <li class=" dropdown">
                <a class=" dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Category
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  @foreach (App\Models\Category::get() as $item)
                  <li><a class="dropdown-item" href="/categorybook/{{$item->id}}">{{$item->catname}}</a></li>
                  @endforeach
                 
                   
                 </ul> 
              </li>
  
              @if (Auth::check())
              @can("isAdmin")
              <li class="">
                <a class=" active" aria-current="page" href="/admindashboard">Dashboard</a>
              </li>
          @elsecan("isAuther")
              <li class=" dropdown">
                <a class=" dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Services
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                   <li><a class="dropdown-item disabled text-info fw-bold">Books</a></li>
                  <li><a class="dropdown-item" href="/book/create">Add Book</a></li>
                  <li><a class="dropdown-item" href="/authorownbook">My Books</a></li>
                   <li><a class="dropdown-item" href="/pendingbooks">Pending Books</a></li>
                   <li><a class="dropdown-item" href="/canceldbooks">Canceld Books</a></li>
                   <li><hr class="dropdown-divider"></li>
                   <li><a class="dropdown-item disabled text-info fw-bold " >Orders</a></li>
                   <li><a class="dropdown-item" href="/pendingorders">Pending Orders</a></li>
                   <li><a class="dropdown-item" href="/canceldorders">Canceld Orders</a></li>
                   <li><a class="dropdown-item" href="/deleverdorders">Deliverd Orders</a></li>
                </ul>
              </li>
              
      @else
      <li class="">
        <a class=" active" aria-current="page" href="/cart">Cart</a>
      </li>
    <li class="">
        <a class=" active" aria-current="page" href="/favorat">Wishlist</a>
      </li>
      @endcan 
  
              <li class=" dropdown">
                <a class=" dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span><i class="ri-user-line"></i></span>  {{substr(auth()->user()->name,0,8)}}
                     
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
@if (auth()->user()->role=="user")
<li><a type="button" class="dropdown-item asd"  href="/account"  >My Account</a></li>
    
@else
<li><a type="button" class="dropdown-item asd"  href="/user/profile"  >My Account</a></li>
    
@endif
                 
                  <li>
                    <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <a href="route('logout')"
                              onclick="event.preventDefault();
                                          this.closest('form').submit();" style="text-decoration: none;" class="dropdown-item">log out
  
                      </a>
                  </form> 
                  </li>
                 </ul>
              </li>
             
              
              @else
              <li class="">
                <a class=" active" aria-current="page" href="/myaccount">Login &nbsp;  / &nbsp;   Register</a>
              </li>
              @endif
              <li>
                <div style="color: aliceblue;margin-top:-7px">           
                  <form action="/search" method="GET"  class="d-flex search-wrappers ">
                 @csrf
                 <input class="form-control  " type="search" placeholder="Search" aria-label="Search"  name="search" required>
                 <button class="btn btn-outline-success" type="submit">Search</button>
               </form></div> 
              </li>
            </ul>
            
          </div>
        </div>
      </nav>
       
        {{-- <div class="section__container header__container">
          <div class="header__content">
            <h2 class="section__subheader"> <span style="color: aliceblue;">Kalamah</span>  Waharf</h2>
            <p class="section__headerone">
              Kalamah Waharf aims to create a comprehensive digital
              platform offering a wide variety of books across different fields, catering
              to readers who speak both Arabic and English.            </p>
           
          </div>
          <div class="header__socials">
            <span style="color: white;background-color:black;border-radius: 40px;width:250px;height:150px" class="fw-bold fs-5 p-2 help"> 
              &#128075; Need Help ?  </span>&nbsp;
             
    <button type="button" class="btn  " data-bs-toggle="modal" data-bs-target="#exampleModal2" data-bs-whatever="@mdo" style="background-color: #0038a8;color:white;border-radius: 40px;width:60px;height:60px"><i class="bi bi-chat-square-dots fw-bold fs-3 pt-2"></i></button>
             
          </div>
        </div> --}}
{{--       
       <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #0038a8;color:white;">
              <span class="ms-4 fw-bold"> Support Chat</span>
              <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mb-3 " id="ddd">
             <div style="background-color: #0038a8;color:white;width:max-content;border-radius: 10px;padding:8px;margin-top:5px; " > Hello, How Can I help You ?</div>
              
            </div>
            
            <div class="modal-footer pe-4" >
               
                
              
                <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Enter Your Request"   aria-describedby="basic-addon2" id="inputdata">
                <span class="input-group-text" id="basic-addon2"><button   type="button" class="btn btn-primary" id="explain"><i class="bi bi-send"></i></button></span>
              </div>
           
            </div>
          </div>
        </div>
      </div> --}}
      
      </header>
    





 
    
    <div  >
        @yield('mynav')
      </div>
      {{-- <script type="text/javascript">
 
    $(document).ready(function() {   
        $('#explain').on('click', function() {
         
        var question=$('#inputdata').val();
     
       var ddd =$('#ddd')


       ddd.append("<div style='background-color:#7484a5;color:white;width:50%;border-radius: 10px;padding:8px;margin-top:5px;margin-left:50%;'>" + question +"</div>");

          $.ajax({

                url: '/explain' ,
                type: 'GET',
                dataType: 'json',
                data:{'question': question}, 
                success: function(response) {
                  
                 

              var message = response.message;
                  // var userList = $('#userList');
                  message.forEach(function(messag) {
                    // ddd.append(messag.answer);
                    if (!$.isEmptyObject(messag.answer)) {
                    ddd.append("<div style='background-color: #0038a8;color:white;width:50%;border-radius: 10px;padding:8px;margin-top:5px;'>" + messag.answer +"</div>");

                     console.log(messag.answer)
                    } else {
                      ddd.append("<div style='background-color: #0038a8;color:white;width:50%;border-radius: 10px;padding:8px;margin-top:5px;'>I dont`t know</div>");

                      console.log("messaganswer")
                    }
                   

                        });

                    //  console.log(message)
                  $("#inputdata").val("");

                   
                 },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });


});
    });
</script> --}}
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
      <script src="https://unpkg.com/scrollreveal"></script>

    <script src="{{ URL::asset('js/main.js') }}"></script>
    <script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
    integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
    crossorigin="anonymous"
  ></script>
  
</body>
</html>
