<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css"> --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <title>Document</title>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">
            <img src="{{URL::asset('/images/download-removebg-preview.png')}}"  alt="notfound" width="130px" height="60px">


          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse ms-4" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/">Home</a>
              </li> 
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Menu
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="/about">About Us</a></li>
                   <li><a class="dropdown-item" href="/contacts/create">Contact Us</a></li>
                 </ul>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/admindashboard">Dashboard</a>
              </li>
          @elsecan("isAuther")
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Books
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="/book/create">Add Book</a></li>
                  <li><a class="dropdown-item" href="/authorownbook">My Books</a></li>
                   <li><a class="dropdown-item" href="/pendingbooks">Pending Books</a></li>
                   <li><a class="dropdown-item" href="/canceldbooks">Canceld Books</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Orders
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="/pendingorders">Pending Orders</a></li>
                   <li><a class="dropdown-item" href="/canceldorders">Canceld Orders</a></li>
                   <li><a class="dropdown-item" href="/deleverdorders">Deliverd Orders</a></li>
                </ul>
              </li>
      @else
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/cart">Cart</a>
      </li>

      @endcan

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                 {{auth()->user()->name}}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModalone" >Profile</button></li>
                  <li>
                    <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <a href="route('logout')"
                              onclick="event.preventDefault();
                                          this.closest('form').submit();" style="text-decoration: none;color:rgb(73, 74, 75)" class="dropdown-item">log out

                      </a>
                  </form> 
                  </li>
                 </ul>
              </li>
             
              
              @else
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/myaccount">Login &nbsp;  / &nbsp;   Register</a>
              </li>
              @endif
            </ul>
            <form action="/search" method="GET"  class="d-flex">
              @csrf
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"  name="search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
      <div class="mt-4 mb-4">
        @yield('mynav')
      </div>

      @if (Auth::check())

      <div class="modal fade" id="exampleModalone" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Profile Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form>
                <div>
               <div class="mb-3">
               <img  src="{{URL::asset('/images/profile/'.auth()->user()->photo)}}" alt="" width="150px" height="150px" style="border-radius: 80px">
               </div>
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label fw-bold">Name : </label> {{auth()->user()->name}}
                 </div>
                   
                   <div class="mb-3">
                    <label for="recipient-name" class="col-form-label fw-bold">Email : </label> {{auth()->user()->email}}
                   </div>
                   
                   
 
          </form>
          </div>
        </div>
      </div>
     @endif
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
     
</body>
</html>