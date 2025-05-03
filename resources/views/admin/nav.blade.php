@can("isAdmin")
<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
  {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css"> --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="stylesheet" href="{{URL::asset('/css/maintwo.css')}}">
    <link rel="stylesheet" href="{{URL::asset('/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{URL::asset('/css/all.min.css')}}">
  {{-- <link rel="stylesheet" href="dist/css/adminlte.min.css"> --}}
  <link rel="stylesheet" href="{{URL::asset('/css/OverlayScrollbars.min.css')}}">

    <style>
        p{
            color: white
        }
    </style>
   
</head>
<body class="hold-transition sidebar-mini layout-fixed"  >
<div class="wrapper">
 

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="bi bi-list "></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/"  class="nav-link">Home</a>
      </li>
      
    </ul>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
   

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{URL::asset('/images/profile/'.auth()->user()->photo)}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block text-decoration-none">{{auth()->user()->email}}</a>
        </div>
      </div>
 

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item  ">
            <a href="/admindashboard" class="nav-link   {{ (request()->is('admindashboard')) ? 'active' : '' }}">
                <i class="bi bi-speedometer2  me-1"></i>
              <p>
                Dashboard
                
              </p>
            </a>
          
          </li>

          {{-- <li class="nav-item  ">
            <a href="/user"  class="nav-link   {{ (request()->is('user')) ? 'active' : '' }}">
                <i class="bi bi-person-lines-fill me-1">
              <p>
                Users 
                
              </p>
            </a>
          
          </li> --}}

          <li class="nav-item  ">
            <a href="/user"  class="nav-link   {{ (request()->is('user')) ? 'active' : '' }}">
                <i class="bi bi-person-lines-fill  me-1"></i>
              <p>
                Users
                
              </p>
            </a>
          
          </li>

          <li class="nav-item  ">
            <a href="/bookrequest"  class="nav-link   {{ (request()->is('bookrequest')) ? 'active' : '' }}">
                <i class="bi bi-book  me-1"></i>
              <p>
                Book Request
                
              </p>
            </a>
          
          </li>

          

          <li class="nav-item  ">
            <a href="/category" class="nav-link   {{ (request()->is('category')) ? 'active' : '' }}">
                <i class="bi bi-view-list  me-1"></i>
              <p>
                Category 
                
              </p>
            </a>
          
          </li>

          <li class="nav-item  ">
            <a href="/order" class="nav-link   {{ (request()->is('order')) ? 'active' : '' }}">
                <i class="bi bi-border-all  me-1"></i>
              <p>
                Orders 
                
              </p>
            </a>
          
          </li>

          <li class="nav-item  ">
            <a href="/adminbooks"  class="nav-link   {{ (request()->is('adminbooks')) ? 'active' : '' }}">
                <i class="bi bi-list-ul  me-1"></i>
              <p>
                My Books
                
              </p>
            </a>
          
          </li>

          <li class="nav-item  ">
            <a href="/book" class="nav-link   {{ (request()->is('book')) ? 'active' : '' }}">
                <i class="bi bi-card-list  me-1"></i>
              <p>
                All Books
                
              </p>
            </a>
          
          </li>
          <li class="nav-item  ">
            <a href="/notification" class="nav-link   {{ (request()->is('notification')) ? 'active' : '' }}">
                <i class="bi bi-bell  me-1"></i> 
              <p>
                Notifications 
                 @if (auth()->user()->unreadNotifications->count() > 0)
                 <span class="right badge badge-danger">New</span>
                 @endif
                
              </p>
            </a>
          
          </li>
          <li class="nav-item  ">
            <a href="/subscription"  class="nav-link   {{ (request()->is('subscription')) ? 'active' : '' }}">
                <i class="bi bi-substack  me-1"></i>
              <p>
                Subscriptions 
                
              </p>
            </a>
          
          </li>
          <li class="nav-item  ">
            <a href="/contacts"  class="nav-link   {{ (request()->is('contacts')) ? 'active' : '' }}">
                <i class="bi bi-chat-square-text  me-1"></i>
              <p>
                Messages 
                
              </p>
            </a>
          
          </li>
          <li class="nav-item  ">
            <a href="/offer" class="nav-link   {{ (request()->is('offer')) ? 'active' : '' }}">
                <i class="bi bi-speedometer2  me-1"></i>
              <p>
                Offers
                
              </p>
            </a>
          
          </li>
      
          <li class="nav-item  ">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();"><button type="button" class=" btn-outline-primary btn-primary-soft   col-12"   ><i class="bi bi-box-arrow-right"></i> &nbsp;Logout &nbsp; </button>

                </a>
            </form>
          
          </li>

          
          
        
        


          













       
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color: #F9FAFB">
  
   

    <!-- Main content -->
    <section class="content" >
      <div class="container-fluid" style="background-color: #F9FAFB">
      
        @yield('mynav')






      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  

   
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
{{-- <script src="plugins/jquery/jquery.min.js"></script> --}}
<script src="{{URL::asset('/js/jquery-3.3.1.min.js')}}"></script> 
<script src="{{URL::asset('/js/jquery-ui.min.js')}}"></script> 
<script src="{{URL::asset('/js/adminlte.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://unpkg.com/scrollreveal"></script>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
@endcan
