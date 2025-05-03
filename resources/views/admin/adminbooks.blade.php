@can("isAdmin")
@extends('admin.nav')
@section('mynav')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{URL::asset('/css/user.css')}}">
    <style>
table::-webkit-scrollbar {
  width: 5px; 
  margin-left: 4px
}
table::-webkit-scrollbar-thumb {
  background: black; 
  border-radius: 10px;
}
    </style>

 
    <title> My Book</title>
</head>
<body style="overflow-x:hidden">
   <center> 

    <br>
    <h1 style="color: #CC5B23">My Books
      <span class="ms-4  ">&nbsp;&nbsp;&nbsp;&nbsp;count: 
        @if(!(App\Models\Book::where('author_id',auth()->user()->id)->get())->isEmpty())
        {{App\Models\Book::where('author_id',auth()->user()->id)->get()->count()}}
      
       @else
         0
     
     @endif    
    </span>
 
    <a href="/addbook"role="button" class="btn btn-primary ms-4  "  > <i class="bi bi-journal-plus  me-1"></i> Add Book</a>

    </h1>
 
<br>
@if(Session::has('success'))
<div class="alert alert-success alert-dismissible" role="alert" style="background-color: #0e3554;color:azure;margin-bottom: -20px;margin-left:10% width:56%; margin-top:50px;font-weight:bolder;text-align:center;" >
  {{Session::get('success')}}
  <button type="button" class="btn-close text-light" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<br><br>
<div class=" " style="margin-left: 5%;  
                           
                           ">
    <div class="row">

        @forelse($data as $item)
          <div class="card mt-2 me-2 col-6  col-md-5 col-lg-4" style="height: 400px;background:#E5E7EB">

            <div class="row g-0">
              <div class="mt-1">
                <img src="{{URL::asset('/images/books/'.$item->photo)}}"  alt="..."  width="200px" height="150px">
              </div>
              <div  >
                <div class="card-body">
                  <h5 class="card-title text-bold">  {{substr($item->bookname,0,40)}}..</h5>
                   <p class="card-text"><small class="text-muted">
                    Price: {{$item->price}}EG &nbsp;

  <button type="button" class="btn     " data-bs-toggle="modal" data-bs-target="#exampleModalone" data-bs-whatever="{{$item->id}}" > <i class="bi bi-award h5"></i></button>


                    
                     @if (App\Models\Offer::where([['book_id',$item->id],['author_id',auth()->user()->id]])->get()->first() !=null)
                    
                     <form method="POST" action="/offer/{{App\Models\Offer::where('book_id',$item->id)->get()->first()->value('id')}}">
                        @method('DELETE')
                        @csrf
                          Offers : {{App\Models\Offer::where([['book_id',$item->id],['author_id',auth()->user()->id]])->get()->value('offer')}} EG &nbsp;
                        
                        <a href="/offer/{{App\Models\Offer::where('book_id',$item->id)->get()->first()->value('id')}}" title="delete offer"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                            
                                            <i class="bi bi-award text-danger h5"></i></a>
                         
                     </form> 




                     @endif
                   

<br>
                    @if ($item->pdf !=null)
                    PDF :
                    <a href="/openpdf/{{$item->pdf}}" title="open pdf"
                       >{{$item->pdf}}</a>
                    @endif
                   

                    <form method="POST" action="/book/{{$item->id}}">
                        @method('DELETE')
                        @csrf
                        <a href="/book/{{$item->id}}" title="delete book"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();"><i class="bi bi-trash3 h4 text-danger"></i></a>&nbsp;&nbsp;
                        <a href="/book/{{$item->id}}/edit" title=" edite book"><i class="bi bi-pencil-square h4 text-success"></i></a>&nbsp;&nbsp;
                 <a href="/book/{{$item->id}}" title="show details"><i class="bi bi-eye-fill h4 text-success"></i></a>
                     
                      </form>    
                
                </small></p>
                </div>
              </div>
            </div>
          </div>
 
          @empty
          <h1 style="color: rgb(108, 180, 244)"> No  Books </h1>
      @endforelse
        
      
</div>
</div>






    

</center>

<div class="modal fade" id="exampleModalone" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Offer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form  action="/offer" method="POST" >
          @csrf
            <input type="hidden" class="form-control" id="recipient-book" name="book_id"  >

          <div class="mb-3">
            <label for="recipient-name" class="col-form-label"> Price Offer :</label>
            <input type="number" class="form-control" id="recipient-name" name="offer" min="1">
          </div>
        
        
      </div>
      <div class="modal-footer">
         <button type="submit" class="btn btn-primary">ADD</button>
      </div>
    </form>
    </div>
  </div>
</div>

<script>
var exampleModal = document.getElementById('exampleModalone')
exampleModal.addEventListener('show.bs.modal', function (event) {
   
  var button = event.relatedTarget
  var recipient = button.getAttribute('data-bs-whatever')
 
   
  var modalBodyInput = document.getElementById('recipient-book')

 
  modalBodyInput.value = recipient
})
</script>
</body>
</html>
@endsection
@endcan
