@can("isAdmin")
@extends('admin.nav') 
@section('mynav') 
<html>
    <header>
        {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}
        <link rel="stylesheet" href=" {{ URL::asset('css/form.css') }} " >
     
    </header>
 
    <body style="overflow-x:hidden">
 
<div class="container" >
<div class="row" style="margin-left:5%;">
<div id="form-main"  >
    <div id="form-div"  class="pt-4"  >
        <form action="/book" method="post" enctype="multipart/form-data">
             
            @csrf
    <div class="mb-3">
      <label for="name" class="form-label">Book Name <span style="color: red">*</span></label>
      <input type="text" class="form-control" id="name"  name="bookname"  required  > 
     
    </div>
    <div class="mb-3">
      <label for="ingredients" class="form-label">Details <span style="color: red">*</span></label>
       <textarea class="form-control"    id="ingredients"  name="details"  required  style="height: 80px"   ></textarea>
      
   
    </div>
      <div class="mb-3">
        <label for="prepare" class="form-label">Price <span style="color: red">*</span></label>
        <input type="number" class="form-control" id="price"  name="price"  required  min="1"> 

   
      </div> 
      <div class="mb-3">
        <label for="prepare" class="form-label">Category <span style="color: red">*</span></label>
         <select class="form-select" aria-label="Default select example" name="cat_id">
             @foreach (App\Models\Category::get() as $collection   )
            <option value="{{$collection->id}}">{{$collection->catname}}</option>
                
            @endforeach
            
          </select>
          
          
      </div> 
      <div class="mb-3">
        <label for="prepare" class="form-label">Book Cover <span style="color: red">*</span></label><br>
        <input type="file"   name="photo" id="" placeholder="chose photo" aria-describedby="fileHelpId" accept="image/*" required >

      </div> 
      <div class="mb-3">
        <label for="pdf" class="form-label">Book PDF <span style="color: red">*</span></label><br>
        <input type="file"   name="pdf" id="pdf" placeholder="chose Pdf" aria-describedby="fileHelpId"  accept=".pdf" required>

      </div>
      
   

    <button type="submit" class="btn btn-primary  mt-2 mb-3" style="margin-left: 230px">ADD Book</button>
  </form>
</div> 
</div>

</div>
</div>
 <br>
 <br>
 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
     

</body>
</html>
 
@endsection
@endcan
