@extends('nav')
@section('mynav') 
<html>
    <header>
         <link rel="stylesheet" href=" {{ URL::asset('css/form.css') }} " >
     
    </header>
 
    <body >
    
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
      <br>
      <br> 
          <div id="form-main" style="margin-top: 50px" >
    <div id="form-div"  class="pt-4">
        <form action="/book/{{$data->id}}" method="post" enctype="multipart/form-data">
            @method("PUT")
            @csrf
    <div class="mb-3">
      <label for="name" class="form-label">Book Name <span style="color: red">*</span></label>
      <input type="text" class="form-control" id="name"  name="bookname"  required value="{{$data->bookname}}"> 
     
    </div>
    <div class="mb-3">
      <label for="ingredients" class="form-label">Details <span style="color: red">*</span></label>
       <textarea class="form-control"    id="ingredients"  name="details"   style="height: 80px" required  >{{$data->details}}</textarea>
      
   
    </div>
      <div class="mb-3">
        <label for="prepare" class="form-label">Price <span style="color: red">*</span></label>
        <input type="number" class="form-control" id="price"  name="price"  required value="{{$data->price}}" min="1"> 

   
      </div> 
      <div class="mb-3">
        <label for="prepare" class="form-label">Category <span style="color: red">*</span></label>
         <select class="form-select" aria-label="Default select example" name="cat_id">
            <option selected value="{{$data->cat_id}}">{{App\Models\Category::where('id',$data->cat_id)->get()->value('catname')}}</option>
            @foreach (App\Models\Category::get() as $collection   )
            <option value="{{$collection->id}}">{{$collection->catname}}</option>
                
            @endforeach
            
          </select>
          
          
      </div> 
      <div class="mb-3">
        <label for="prepare" class="form-label">Update Cover </label><br>
        <input type="file"   name="photo" id="" placeholder="chose photo" aria-describedby="fileHelpId" accept="image/*"  >

      </div> 
      <div class="mb-3">
        <label for="pdf" class="form-label">Update PDF</label><br>
        <input type="file"   name="pdf" id="pdf" placeholder="chose photo" aria-describedby="fileHelpId"  accept=".pdf" >

      </div>
      <div class="mb-3">
        <label for="cover" class="form-label">Book Cover</label><br>
        <img src="{{URL::asset('/images/books/'.$data->photo)}}"  alt="..."  width="100px" height="100px">
 
      </div> 
      @if ($data->pdf !=null)
      <div class="mb-3">

        <label for="" class="form-label">Book PDF : </label> 

                    <a href="/openpdf/{{$data->pdf}}" title="open pdf"
                       > {{$data->pdf}}</a>
      </div> 
      @endif

    <button type="submit" class="btn btn-primary  mt-2 mb-3" style="margin-left: 250px">Update Book</button>
  </form>
</div>
</div>
 <br>
 <br>
 
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
     

</body>
</html>
 
@endsection
 
