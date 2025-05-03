@extends('nav')
@section('mynav')
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css"
      rel="stylesheet"
    />

    <link rel="stylesheet" href=" {{ URL::asset('css/style.css') }} " >
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!-- owl carousel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Home</title>
  </head> 
  <body   style="overflow-x: hidden">
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
    <div class="collapse  sidenav    id="element1"   >
     <div class="text-center p-2 " style="background-color: #0038a8;color:white;">
      <span class="  fw-bold  "> Support Chat</span>
     </div>
     <div>
          
    <div style="height:250px;overflow: auto;">
      <div class=" mt-2 ms-1 " id="ddd"  >
         <div style="background-color: #0038a8;color:white;width:max-content;border-radius: 10px;padding:8px;margin-top:5px; " > Hello, How Can I help You ?</div>
          
        </div> 
      </div>
      
        <div   class="input-group  position-absolute bottom-0 start-0  ">
            <input type="text" class="form-control" placeholder="Enter Your Request"   aria-describedby="basic-addon2" id="inputdata">
            <span class="input-group-text" id="basic-addon2"><button   type="button" class="btn btn-primary" id="explain"><i class="bi bi-send"></i></button></span>
          </div>
      </div>
    </div>
    <section class="hero">
      <h1>Discover Your Next Favorite Book</h1>
      <p>
        Kalamah Waharf aims to create a comprehensive digital
        platform offering a wide variety of books across different fields, catering
        to readers who speak both Arabic and English.

        <p  class="text-right ">
          <span style="color: white;background-color:black;border-radius: 40px;width:250px;height:150px" class="fw-bold fs-5 p-2 help"> 
            &#128075; Need Help ?  </span>&nbsp;
           
  <button type="button" class="btn  texttog"  style="background-color: #0038a8;color:white;border-radius: 40px;width:60px;height:60px"><i class="bi bi-chat-square-dots fw-bold fs-3 pt-2"></i></button>
           
        </p>
      </p>
       
      </section>
      <section class="book-section">
        <a href="/newbooks" class="text-dark">

          <div class="book-card">
          <h3>New  Books</h3>
          <p> contains all types of newly added books 
            and everything we want from the types of books available on our website.</p>
        </div>
      </a>
      <a href="/recommended"  class="text-dark">

        <div class="book-card">
          <h3>Recommendation Books</h3>
          <p>
              Aims to suggest some books 
            based on your research or books that the site recommends.
          </p>
        </div>
      </a>
      <a href="/bestselling"  class="text-dark">

        <div class="book-card">
          <h3>Best Selling</h3>
          <p>
            Best Selling Books , It aims to display best-selling books
            that are saled more throught users by all authors .
          </p>
        </div></a>
      </section>
      <center class="mb-4 h1 text-darck " > Top Authors</center><br>
      @php
    $bannedAuthors = App\Models\Block::pluck('user_id')->toArray(); // الحصول على قائمة المحظورين
@endphp

<section class="apper">
  <div class="carousel owl-carousel">
    @foreach (App\Models\Order::orderByDesc('quantaty')->get()->groupBy('author_id') as $item)
    @foreach ($item as $key)
    @if ($loop->first)

    @if (!in_array($key->author_id, $bannedAuthors)) 
    <div class="card"  > 
       <a href="/authorbook/{{$key->author_id}}" style="text-decoration: none ">
      <figure >
          <img src="{{URL::asset('/images/profile/'.App\Models\User::where('id',$key->author_id)->get()->value('photo'))}}" width="250px" height="250px"   class="imageauthor" />
          <figcaption class="  mt-4   ms-4 ">
               <h4 style="color:black"  >  
                {{substr(App\Models\User::where('id',$key->author_id)->get()->value('name'),0,12)}}
                   </h4>
           </figcaption>
          </figure>
  </a></div>
  @endif
  @endif
  @endforeach
@endforeach
    
 
  </div>
</section>
 
    <div class="mt-4">
      <br><br>
  @include('user.subscription')
  
  </div>

   
  <script type="text/javascript">
 
      
      $(document).ready(function () {
        $(".sidenav").hide();
                $(".texttog").click(function(){
                 $(".sidenav").slideToggle();
  });




        
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

                     console.log(message)
                  $("#inputdata").val("");

                   
                 },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });


});






       $(".carousel").owlCarousel({
         loop: true,
         margin: 25,
         autoplay: false,
         autoplayTimeout: 1000,
         autoplayHoverPause: true,
         nav: true,
         navText: ["<i class='bi bi-chevron-double-left h2'></i>", "<i class='bi bi-chevron-double-right h2'></i>"],
         responsive: {
           0: {
             items: 1,
           },
           600: {
             items: 2,
           },
           1000: {
             items: 3,
           },
         }
       });
    });
</script>
    <script src="https://unpkg.com/scrollreveal"></script>
   
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@floating-ui/core@1.6.8"></script>
<script src="https://cdn.jsdelivr.net/npm/@floating-ui/dom@1.6.12"></script>
    {{-- <script src="{{ URL::asset('js/main.js') }}"></script> --}}
  </body>
</html>
@endsection