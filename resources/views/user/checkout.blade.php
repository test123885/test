@extends('nav')
@section('mynav')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Check out</title>
    <script src="{{URL::asset('/js/jquery-3.3.1.min.js')}}"></script> 

</head>
<style>
  body{
    overflow-x: hidden !important;
  }
</style>
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

    <div  class="container mt-3 mb-4 ">
        <center class="mb-4 h1 text-light" > Checkout</center>
        <div class="row ms-4"  >
<div class="col-12 col-lg-7 mb-4">
    <div class="card ">
        <div class="card-body">
      <h4 style="color: #2796AD">Billing Details</h4>
      
<form action="/order" method="post">
  @csrf
    <div class="mb-3 mt-4">
        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="name" name="name" required >
      </div>
      <div class="mb-3 mt-4">
        <label for="email" class="form-label">Email  <span class="text-danger">*</span></label>
        <input type="email" class="form-control" id="email" name="email"  required >
      </div>
      <div class="mb-3 mt-4">
        <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="phone" name="phone"  required>
      </div>
      <div class="mb-3 mt-4">
        <label for="stat" class="form-label">Stat <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="stat" name="stat"  required>
      </div>
      <div class="mb-3 mt-4">
        <label for="city" class="form-label">City <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="city" name="city" required >
      </div>
      <div class="mb-3 mt-4">
        <label for="streetnumber" class="form-label">Street Number <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="streetnumber" name="streetnumber"  required>
      </div>
      <div class="mb-3 mt-4">
        <label for="notes" class="form-label">Notes</label>
        <textarea class="form-control" id="notes" rows="3" name="notes"></textarea>
      </div>

 



            
        </div>
      </div>
      
      <input type="hidden" class="form-control" id="method" name="method" value="cash"  >
       
</div>
<br>
<div class="col-12 col-lg-4">
    <div class="card">
        <div class="card-body">
          <h1 style="color: #2796AD">Order Totals</h1>
 
          <table class="table    mt-3"  >
             
            <tbody>
           
           @foreach ($data as $item)
                 
              <tr>
                <th >   
                     <img src="{{URL::asset('/images/books/' .App\Models\Book::where('id',$item->book_id)->get()->value('photo'))}}" style="width: 150px;height:150px"  />
                    &nbsp;<span   >
                      {{substr(App\Models\Book::where('id',$item->book_id)->get()->value('bookname'),0,15)}}..
                       </span> <br><br>
                    <span style="color:#0a7287">x{{$item->quantaty}}</span> 
                </th>
                @if (App\Models\Offer::where('book_id',$item->book_id)->get()->first() !=null)

                     <td class="col-3 price pt-4" data-value="{{App\Models\Offer::where('book_id',$item->book_id)->get()->value('offer')  * $item->quantaty}}">
            EGP{{App\Models\Offer::where('book_id',$item->book_id)->get()->value('offer')  * $item->quantaty}}</td>
    
                @else
                
           <td class="col-3 price pt-4" data-value="{{App\Models\Book::where('id',$item->book_id)->get()->value('price')  * $item->quantaty}}">
            EGP{{App\Models\Book::where('id',$item->book_id)->get()->value('price')  * $item->quantaty}}</td>
    
                @endif
              </tr>
           @endforeach
             

            </tbody>
          </table>
         
          <br>
          <h5>
            Book Type <span class="text-danger">*</span> : 

            </h5><br>
                <input type="radio" id="radio1" name="booktype" value="pdf" required>
                <label for="radio1">PDF only</label>
                <input type="radio" id="radio2" name="booktype" value="pdf with paper" style="margin-left: 40px" required >
                <label for="radio2">PDF with Paper</label><br><br>
            
              <br>
          <h3 style="color: #045565">
            Total : EGP <span id="mony"> </span>
          </h3><br>
          <button type="submit"   class="btn  p-2 w-100 "  role="button" style="background-color: #2796AD" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Order &nbsp; <i class="bi bi-arrow-right"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
        </form>

        </div>
      </div>
</div>
        </div>
       
        </div>

        <div class="mt-4">
            <br><br><br>
        @include('user.subscription')
        
        </div>


        <script type="text/javascript">
          $(window).on('load',function () {
         let total=0;
   
        $('.price').each(function(){
          total += Number($(this).attr('data-value'));
        
        })
        $("#mony").text(total);

        //  console.log(total);
        
  
            });

               $(document).ready(function() {  
                
                let total=0;
   
   $('.price').each(function(){
     total += Number($(this).attr('data-value'));
   
   })


        $('#radio2').on('change', function() {
          
        $("#mony").text(total + 500);
                
        });

        $('#radio1').on('change', function() {
          
          $("#mony").text(total);
                  
          });
      });
   

        </script>   
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
@endsection