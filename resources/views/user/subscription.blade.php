<link rel="stylesheet" href=" {{ URL::asset('css/subscrip.css') }} " >
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<div class="  border border-2 shadow ms-1  mb-4 mt-4  backimage"  > 

 

             

 
<footer class="footer">
<div class="container">
  <div class="row  section__container footer__container  ">
   
    <div class="footer__col col-12">
      <h4>More on The Kalamah Waharf</h4>
      <ul class="footer__links">
        <li><a href="/newbooks">All Books</a></li>
        <li><a href="/bestselling">Best selling </a></li>
        <li><a href="/recommended">Recommendation</a></li>
        <li><a href="/allauthors">All Authors </a></li>
         
        

      
      </ul>
    </div>
    <div class="footer__col col-12"  >
      <h4>More </h4>
      <ul class="footer__links">
        <li><a href="/">Home</a></li>
        <li><a href="/about">About </a></li>
        <li><a href="/contacts/create">Contact Us</a></li>
        @if (Auth::check())
        <li><a href="/user/profile">My Account</a></li>
        @endif
      </ul>
    </div>
    <div class="footer__col col-12"  >
      <h4>Subscrip To Our News! </h4>
      <ul class="footer__links">
        <li class="text-light mb-3">Subscrip To get new</li>
        <li>      <form  method="POST" action="/subscription"  class="search-wrapper cf">
          @csrf
          <input type="text" placeholder="Enter your email..." required style="box-shadow: none" name="email">
          <button type="submit" class="fw-bold">Subscripe</button>
        </form>  </li>
       
       
      </ul>
    </div>
  </div>
</div>
  <div  class=" text-center mb-4 text-light">
     <i class="bi bi-facebook h2"></i>
    <i class="bi bi-instagram ms-4 h2"></i>
  </div>
   <div class="m-4 text-center text-light">
    © Copy right KalamahWaharf 2025
  </div>
  <br>
</footer>