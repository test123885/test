@extends('nav')
@section('mynav')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href=" {{ URL::asset('css/form.css') }} " >

    <title>Add Book</title>
</head>
<body
style="background-color: rgb(239, 238, 238)"
>
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
    <div id="form-main" style="margin-top: 50px" >
        <div id="form-div"  class="pt-4">
          <form action="/book" method="post" enctype="multipart/form-data">
            @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Book Name <span style="color: red">*</span></label>
          <input type="text" class="form-control" id="name"  name="bookname"  required> 
         
        </div>
        <div class="mb-3">
          <label for="details" class="form-label">Details <span style="color: red">*</span></label>
           <textarea class="form-control"    id="details"  name="details"   style="height: 50px" required></textarea>
          
       
        </div>
          <div class="mb-3">
            <label for="prepare" class="form-label">Price <span style="color: red">*</span></label>
            <input type="number" class="form-control" id="price"  name="price"  required min="1"> 
    
       
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
            <input type="file"   name="photo" id="" placeholder="chose photo" aria-describedby="fileHelpId"  accept="image/*" required>
    
          </div> 
          <div class="mb-3">
            <label for="prepare" class="form-label">Book PDF <span style="color: red">*</span></label><br>
            <input type="file"   name="pdf" id="" placeholder="chose pdf" aria-describedby="fileHelpId"   accept=".pdf" required>
    
          </div> 
        <button type="submit" class="btn btn-primary  mt-2 mb-3" style="margin-left: 250px">Add Book</button>
      </form>
    </div>
    </div>
     <br>
     <br>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
@endsection
