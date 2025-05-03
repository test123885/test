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
<br><br>
   <div class="  row  " style="margin-left: 20%">
    
   <span class="row col-4 col-md-2 me-2  " >
    <select class=" form-select updatepageofcategory offer" aria-label="Default select example" style="" id=" ">
    <option value="0" selected>All</option>
    <option value="1">Offers</option>
     

  </select>
   </span>
 <span class="row col-5 col-md-3 " >
  <select class=" form-select  updatepageofcategory price" aria-label="Default select example" style=" " id="">
                        <option value="desc" selected>price from hight to low </option>

                        <option value="asc" >price form low to high</option>
                   

                      </select>
                     


                       </span>
 <span class="row col-4 col-md-2 ms-1" >


    <button type="button" class="btn btn-outline-dark " data-bs-toggle="modal" data-bs-target="#priceModal" data-bs-whatever="@mdo"> Price</button>
 </span>
    </div>  


                    

<div>   


 
</div>
 <section class="book-section" id="secbook">
    @forelse ($data as $item)  


          <div class="book-card border border-dark  position-relative">
            @if (App\Models\Offer::where('book_id',$item->id)->get()->first() !=null)
          <div class="position-absolute top-0 start-0">
  <img src="{{URL::asset('/images/ddddPNG-removebg-preview.png')}}" alt="blue square" width="60px" height="60px"/>   
           
          </div>
          @endif
           <p>
            <figure >
                <a href="/details/{{$item->id}}" style="text-decoration: none">

                <img src="{{URL::asset('/images/books/'.$item->photo)}}" width="50px" height="150px" />
 
                   </a> 
              
                  <figcaption class="text-center    ">
                    <h4  style="color: black;height:140px">{{$item->bookname}}</h4><br>
                 <h4 style="color: slategray;height:50px">{{App\Models\User::where('id',$item->author_id)->get()->value('name')}}</h4>
                 <h4 style="color: slategrey"> 
                  
                  
                  
                  @if (App\Models\Offer::where('book_id',$item->id)->get()->first() !=null)

                
                    EGP{{App\Models\Offer::where('book_id',$item->id)->get()->value('offer')}}
                  @else
                    EGP  {{$item->price}} 
                  @endif
                  
                  
                  
                  
                  
                  </h4>
                     <h4>
                       
     @if (Auth::check())

      
@if (!(App\Models\Favorat::where([['book_id',$item->id],['user_id',auth()->user()->id]])->get())->isEmpty())
           

<form action="/favorat" method="POST"  style="display: inline" >
 @csrf
 <input type="hidden" name="book_id" value="{{$item->id}}" style="display: inline">
 
  <button type="submit" class="btn btn-outline-danger  border-0"  style="display: inline"  ><i class="bi bi-suit-heart-fill h4"></i> </button>
</form>




     
@else
<form action="/favorat" method="POST" style="display: inline" >
 @csrf
      <input type="hidden" name="book_id" value="{{$item->id}}" style="display: inline">

  <button type="submit" class="btn btn-outline " style="display: inline"  ><i class="bi bi-suit-heart-fill h4"></i> </button>
</form>
     
@endif
@else
<form action="/favorat" method="POST" style="display: inline" >
@csrf
   <input type="hidden" name="book_id" value="{{$item->id}}" style="display: inline">

<button type="submit" class="btn btn-outline " style="display: inline"  ><i class="bi bi-suit-heart-fill h4"></i> </button>
</form>

@endif

                        


                        </h4>
                 </figcaption>
                 </figure>
            
            </p>
        </div>

      @empty
          <h1 style="color: rgb(108, 180, 244)"> No  Books </h1>
          
      @endforelse
  </section>


 
 
 
 
 
  
        
        <div class="mt-4">
            <br><br><br>
        @include('user.subscription')
        
        </div>

        <div class="modal fade" id="priceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"   >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #0038a8;color:white;">
              <h5 class="modal-title" id="exampleModalLabel">select price</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
            
               
                
                <div class="mb-3">
                  MinPrice :
                   <input type="number" name=" " min="1"   class="form-control minprice"   />
                </div>
                <div class="mb-3">
                  MaxPrice :
                   <input type="number" name=" " min="1"   class="form-control maxprice"   />
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary filterprice ">Show</button>
            </div>
       
          </div>
        </div>
      </div>




<script>
    $(document).ready(function() {   


      $(".updatepageofcategory").on("change", function(){
              
              var offer = $('.offer').val();
              var price = $('.price').val();
              var catid=<?php echo $id; ?>;
              // console.log(catid);
              $.ajax({
  
                  url: '/updatepageofcategory' ,
                  type: 'GET',
                  dataType: 'json',
                  data:{'offer': offer,'price':price,'catid':catid}, 
                  success: function(response) {
       
                    var books = response.books;
                          var booksection = $('#secbook');
                          booksection.empty();
                          if (books.length == 0) {
                        $('#secbook').append(`<h1 class='text-center'> No Books Found</h1>`);
                      }
          
                          books.forEach(function(book) {
                            let offerContent = book.offer ? `<div class="position-absolute top-0 start-0">
            <img src="/images/ddddPNG-removebg-preview.png" alt="blue square" width="60px" height="60px"/>
        </div>` : '';

                            booksection.append(
                              `
            <div class="book-card border border-dark  position-relative">

         ${offerContent}

             <p>
              <figure >
                  <a href="/details/`+book.id+`" style="text-decoration: none">
  
                  <img src="{{URL::asset('/images/books/${book.photo}')}}" width="50px" height="150px" />
  
                     </a>
                
                    <figcaption class="text-center    ">
                      <h4  style="color: black;height:100px">`+book.bookname +`</h4><br>
                   <h4 style="color: slategray;height:50px">{{App\Models\User::where('id',`+book.author_id +`)->get()->value('name')}}</h4>
                   <h4 style="color: slategrey">    
                <h4 style="color: slategrey">
                                EGP ${book.offer ? book.offer : book.price}
                            </h4>

                       <h4>
                         
       @if (Auth::check())
  
        
  @if (!(App\Models\Favorat::where([['book_id',`+book.id +`],['user_id',auth()->user()->id]])->get())->isEmpty())
             
  
  <form action="/favorat" method="POST"  style="display: inline" >
   @csrf
   <input type="hidden" name="book_id" value="`+book.id +`" style="display: inline">
   
    <button type="submit" class="btn btn-outline-danger  border-0"  style="display: inline"  ><i class="bi bi-suit-heart-fill h4"></i> </button>
  </form>
  
  
  
  
       
  @else
  <form action="/favorat" method="POST" style="display: inline" >
   @csrf
        <input type="hidden" name="book_id" value="`+book.id +`" style="display: inline">
  
    <button type="submit" class="btn btn-outline " style="display: inline"  ><i class="bi bi-suit-heart-fill h4"></i> </button>
  </form>
       
  @endif
  @else
  <form action="/favorat" method="POST" style="display: inline" >
  @csrf
     <input type="hidden" name="book_id" value="`+book.id +`" style="display: inline">
  
  <button type="submit" class="btn btn-outline " style="display: inline"  ><i class="bi bi-suit-heart-fill h4"></i> </button>
  </form>
  
  @endif
  
                          
  
  
                          </h4>
                   </figcaption>
                   </figure>
              
              </p>
          </div>
  `
                            );
                          });
                
  
  
                   },
                  error: function(xhr, status, error) {
                    console.error("Error: " + error);
    console.log("Status: " + status);
    console.log("Response Text: " + xhr.responseText);
                  }
              });
          });









    $(".filterprice").on("click", function(){
               
            var offer = $('.offer').val();
            var price = $('.price').val();
            var minprice = $('.minprice').val();
            var maxprice = $('.maxprice').val();
            var catid=<?php echo $id; ?>;
            // $("#priceModal .close").click();
            // $('#priceModal').removeClass('show');
           //$('#priceModal').on('hidden.bs.modal', function () {
           //$('body').removeClass('modal-open');
            // });
            // console.log(catid);
            // $('#priceModal').modal('toggle');
            $('.modal').toggle();
$('body').css('overflow-y', 'auto');
 
            
            $.ajax({

                url: '/filterprice' ,
                type: 'GET',
                dataType: 'json',
                data:{'offer': offer,'price':price,'catid':catid,'minprice':minprice,'maxprice':maxprice}, 
                success: function(response) {
             
                  var books = response.books;
                        var booksection = $('#secbook');
                        booksection.empty();
                        if (books.length == 0) {
                      $('#secbook').append(`<h1 class='text-center'> No Books Found</h1>`);
                    }
        
                        books.forEach(function(book) {
                          let offerContent = book.offer ? `<div class="position-absolute top-0 start-0">
            <img src="/images/ddddPNG-removebg-preview.png" alt="blue square" width="60px" height="60px"/>
        </div>` : '';

                            booksection.append(
                              `
            <div class="book-card border border-dark  position-relative">

         ${offerContent}

             <p>
              <figure >
                  <a href="/details/`+book.id+`" style="text-decoration: none">
  
                  <img src="{{URL::asset('/images/books/${book.photo}')}}" width="50px" height="150px" />
  
                     </a>
                
                    <figcaption class="text-center    ">
                      <h4  style="color: black;height:100px">`+book.bookname +`</h4><br>
                   <h4 style="color: slategray;height:50px">{{App\Models\User::where('id',`+book.author_id +`)->get()->value('name')}}</h4>
                   <h4 style="color: slategrey">    
                <h4 style="color: slategrey">
                                EGP ${book.offer ? book.offer : book.price}
                            </h4>

                       <h4>
                         
       @if (Auth::check())
  
        
  @if (!(App\Models\Favorat::where([['book_id',`+book.id +`],['user_id',auth()->user()->id]])->get())->isEmpty())
             
  
  <form action="/favorat" method="POST"  style="display: inline" >
   @csrf
   <input type="hidden" name="book_id" value="`+book.id +`" style="display: inline">
   
    <button type="submit" class="btn btn-outline-danger  border-0"  style="display: inline"  ><i class="bi bi-suit-heart-fill h4"></i> </button>
  </form>
  
  
  
  
       
  @else
  <form action="/favorat" method="POST" style="display: inline" >
   @csrf
        <input type="hidden" name="book_id" value="`+book.id +`" style="display: inline">
  
    <button type="submit" class="btn btn-outline " style="display: inline"  ><i class="bi bi-suit-heart-fill h4"></i> </button>
  </form>
       
  @endif
  @else
  <form action="/favorat" method="POST" style="display: inline" >
  @csrf
     <input type="hidden" name="book_id" value="`+book.id +`" style="display: inline">
  
  <button type="submit" class="btn btn-outline " style="display: inline"  ><i class="bi bi-suit-heart-fill h4"></i> </button>
  </form>
  
  @endif
  
                          
  
  
                          </h4>
                   </figcaption>
                   </figure>
              
              </p>
          </div>
  `
                          );

           

                        });
              


                 },
                error: function(xhr, status, error) {
                  console.error("Error: " + error);
    console.log("Status: " + status);
    console.log("Response Text: " + xhr.responseText);
                }
            });
        });
    });


</script>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
@endsection