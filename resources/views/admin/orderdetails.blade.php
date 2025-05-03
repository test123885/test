@can("isAdmin")
@extends('admin.nav')
@section('mynav')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{URL::asset('/js/jquery-3.3.1.min.js')}}"></script> 

    <title>order Details</title>
</head>
<body style="overflow-x:hidden">
  
    
    <div class="container ms-4 mt-4">
<div class="row col-12">
    <div class="card" style="height: 650px ; display: inline-block;
                        overflow-y: scroll ;
                        scrollbar-width: thin ;
                         scrollbar-color: #d9d9db #fbf9f9;">
         <div class="card-body">
            @foreach ($data as $item)
                
           
                <div  class="mt-3">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label fw-bold ">Author Name : </label> {{App\Models\User::where('id',$item->author_id)->get()->value('name')}}
                       </div>
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label fw-bold ">Book Name : </label> {{App\Models\Book::where('id',$item->book_id)->get()->value('bookname')}}
                 </div>
                 <div class="mb-3"> 
                    <label for="recipient-name" class="col-form-label fw-bold">Book Price : </label>
                    @if (App\Models\Offer::where([['book_id',$item->book_id,['author_id',auth()->user()->id]]])->get()->first() !=null)

                    {{App\Models\Offer::where([['book_id',$item->book_id,['author_id',auth()->user()->id]]])->get()->value('offer')}} EG
                        
                    @else
                    {{App\Models\Book::where('id',$item->book_id)->get()->value('price')}} EG
                        
                    @endif
                    
                   </div> <div class="mb-3">
                    <label for="recipient-name" class="col-form-label fw-bold">Book Countaty : </label> {{$item->quantaty}}
                   </div>
                   <div class="mb-3">

                    @if (App\Models\Offer::where([['book_id',$item->book_id,['author_id',auth()->user()->id]]])->get()->first() !=null)
                    
                    <label for="recipient-name" class="col-form-label fw-bold totalmony" data="{{App\Models\Offer::where([['book_id',$item->book_id,['author_id',auth()->user()->id]]])->get()->value('offer') * $item->quantaty}}">
                        Total Price : </label> {{App\Models\Offer::where([['book_id',$item->book_id,['author_id',auth()->user()->id]]])->get()->value('offer') * $item->quantaty}} EG
 
                    @else
                    <label for="recipient-name" class="col-form-label fw-bold totalmony" data="{{App\Models\Book::where('id',$item->book_id)->get()->value('price') * $item->quantaty}}">
                        Total Price : </label> {{App\Models\Book::where('id',$item->book_id)->get()->value('price') * $item->quantaty}} EG
 
                    @endif
                                      
                </div>
                   <hr>
               
            </div>
            @endforeach
            <form>
            <div class="  text-start">
                {{-- <label for="recipient-name" class="col-form-label fw-bold ">Total Price : </label> 700 EG --}}
                <label for="recipient-name" class="col-form-label fw-bold ms-1 "> 
                    Total Price  :   <span class="fw-light" id="allmony"></span> EG &nbsp;&nbsp;&nbsp;&nbsp;
                    Statuse  :   <span class="fw-light">
                        @foreach ($data as $item)
                        @if ($loop->first)
                                      
                        <input type="hidden" name="" id="booktypecheckout" value="{{App\Models\Checkout::where('id',$item->checkout_id)->get()->value('booktype')}}">
                        {{$item->statuse}}
                          
                    </span>  &nbsp;&nbsp;&nbsp;&nbsp;<br><br>
                    Nots : <span class="fw-light">{{App\Models\Checkout::where('id',$item->checkout_id)->get()->value('notes')}}</span>
                    <br><br>
                  
                    Update Statuse : <span class="row col-6 " >
 
                     <select class="form-select  updatestause " aria-label="Default select example" style="margin-left: 150px;margin-top:-20px" id="{{$item->checkout_id}}">
                        <option value="{{$item->statuse}}" selected>{{$item->statuse}}</option>
                        <option value="canceld">canceld</option>
                        <option value="pending">pending</option>
                        <option value="deleverd" >deleverd</option>

                      </select> </span>
    
                </label>  
                @endif
                        @endforeach 
                 </div>
          </form>
       </div>
   </div>
   
</div>
    </div>
    <script type="text/javascript">
        $(window).on('load',function () {
       let total=0;
 
        $('.totalmony').each(function(){
        total += Number($(this).attr('data'));
        
        })
        if( $('#booktypecheckout').val()=='pdf'){
        $("#allmony").text(total);
       
            
        } else {
        $("#allmony").text(total + 500);
            
        }
        // console.log(total);

    });


    $(document).ready(function() {   
    $(".updatestause").on("change", function(){
              var id = $(this).attr("id");
            var orderstatuse = $(this).val();

            //console.log(orderstatuse);
            $.ajax({

                url: '/updateorderstatuse/'+id ,
                type: 'GET',
                dataType: 'json',
                data:{'status': orderstatuse}, 
                success: function(response) {
     
               window.alert('Order is  ' + response.message);

              window.location.reload();


                 },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });






    </script>
</body>
</html>
@endsection
@endcan