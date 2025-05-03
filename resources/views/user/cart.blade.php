@extends('nav')
@section('mynav')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{URL::asset('/js/jquery-3.3.1.min.js')}}"></script> 

    <title>Document</title>
</head>
<style>
  body{
    overflow-x: hidden !important;
  }
</style>
<body   >
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

    <div  class="container mt-3 mb-4 " >
        <center class="mb-4 h1 text-darck " > Cart</center>
        <div class="row ms-4" style="margin-top: 50px">
<div class="col-12  ">
@forelse ($data as $item)
      <div class="card  mt-2">
        <div class="card-body">
            <table class="table   text-center mt-3" style="border-bottom-style: hidden">
             
                <tbody>
               
                 
                  <tr>
                    <th >   
                         <img src="{{URL::asset('/images/books/'.App\Models\Book::where('id',$item->book_id)->get()->value('photo'))}}" width="30px" height="130px"   />
                    <br>
                    <form method="POST" action="/cart/{{$item->id}}">
                        @method('DELETE')
                        @csrf
                        <a href="/cart/{{$item->id}}" title="delete cbook"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();"><i class="bi bi-trash3 h5 text-danger "></i></a>&nbsp;&nbsp;
                      </form>   
                     </th>
                    <td class="h5 col-3 ">{{App\Models\Book::where('id',$item->book_id)->get()->value('bookname')}}</td>
                    <td class="col-2">EGP 
                         @if (App\Models\Offer::where('book_id',$item->book_id)->get()->first() !=null)

                
                  {{App\Models\Offer::where('book_id',$item->book_id)->get()->value('offer')}}
            @else
             {{App\Models\Book::where('id',$item->book_id)->get()->value('price')}}

            @endif
                    
                    
                    
                    
                    </td> 
                    <td class="col-2">  


                   @if (App\Models\Offer::where('book_id',$item->book_id)->get()->first() !=null)

                        
                    <form action="#" oninput="res.value = {{App\Models\Offer::where('book_id',$item->book_id)->get()->value('offer')}} *quantaty.value">       
                           <input type="number" min="1" class="col-12  ps-2 asd " style="height: 40px" value="{{$item->quantaty}}" name="quantaty" data-value="{{App\Models\Book::where('id',$item->book_id)->get()->value('price')}}"  onkeydown="return false" id="{{$item->id}}">
                    </td>
                    <td class="col-2">EGP <output name='res'  class="res" >{{$item->quantaty * App\Models\Offer::where('book_id',$item->book_id)->get()->value('offer')}}</output>
                    </form>
                    @else
                        
                   
                    <form action="#" oninput="res.value = {{App\Models\Book::where('id',$item->book_id)->get()->value('price')}} *quantaty.value">       
                           <input type="number" min="1" class="col-12  ps-2 asd " style="height: 40px" value="{{$item->quantaty}}" name="quantaty" data-value="{{App\Models\Book::where('id',$item->book_id)->get()->value('price')}}"  onkeydown="return false" id="{{$item->id}}">
                    </td>
                    <td class="col-2">EGP <output name='res'  class="res" >{{$item->quantaty * App\Models\Book::where('id',$item->book_id)->get()->value('price')}}</output>
                    </form>
                     @endif

</td>






                  </tr>
                </tbody>
              </table>
        </div>
      </div> 
      @empty
    <h1 class="text-center"> Your Cart Is Empty</h1>
@endforelse 
</div>
@if (!$data->isEmpty())
    

<div class=" col-7 col-md-6    mt-4" style="margin-left: 25%">
    <div class="card">
        <div class="card-body">
          <h1 style="color: #2796AD">Cart Totals</h1>
          <p class="h3 mt-3">Total Mony :<span class="h5 " style="color: grey"> EGP 
          <span id="totalmony">
          </span>
          
          
          </span> </p>
          <br>
          <a name=""   id=""  class="btn  p-2 w-100 " href="/checkout" role="button" style="background-color: #2796AD" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Cash Pay &nbsp; <i class="bi bi-arrow-right"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
          <a name=""   id=""  class="btn  p-2 w-100  mt-3" href="/checkoutpage" role="button" style="background-color: #2796AD" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Card Pay &nbsp; <i class="bi bi-arrow-right"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
          <a name=""   id=""  class="btn  p-2 w-100 mt-3" href="/clearcart" role="button" style="background-color:red" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Clear Cart  &nbsp; <i class="bi bi-trash3"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>

        </div>
      </div>
</div>
@endif
        </div>
       
        </div>
    

        <div class="mt-4">
            <br><br><br>
        @include('user.subscription')
        
        </div>
        <script type="text/javascript">
        $(window).on('load',function () {
       let total=0;
        
        $('.res').each(function(){
          total += Number($(this).val());
        
        })
        $("#totalmony").text(total);
          // console.log(total);

        });
    $(document).ready(function() {   
        $('.asd').on('click', function() {
        // console.log($(this).val());
        var quantaty=$(this).val();
        var id=$(this).attr('id');
        // console.log(quantaty);

        let total=0;
        
        $('.res').each(function(){
          total += Number($(this).val());
        
    })
     $("#totalmony").text(total);



          $.ajax({

                url: '/updatebookquantaty/'+id ,
                type: 'GET',
                dataType: 'json',
                data:{'quantaty': quantaty}, 
                success: function(response) {
                     
                   
                 },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });


});
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
@endsection


