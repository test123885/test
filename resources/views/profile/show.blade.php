@extends('nav')
@section('mynav')
<head>
      <!-- Fonts -->
      <link rel="preconnect" href="https://fonts.bunny.net">
      <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

      <!-- Scripts -->
      @vite(['resources/css/app.css', 'resources/js/app.js'])

      <!-- Styles -->
      @livewireStyles
</head> 
    <div style="margin-top: 50px ">
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            


            @if (Auth::check())
<div class="row ms-2">
    <div class=" col-12 col-md-4 fw-bold mb-3 ">
        Profile Information
    </div>
    <div class="col-12 col-md-8">
        
        <div class="card mb-3 shadow border-0" style="max-width: 1000px;">
            <div class="row g-0">
              <div class="col-md-4  p-4">
                <img  src="{{URL::asset('/images/profile/'.auth()->user()->photo)}}" alt=""  style="width:100px;height:100px">

              </div>
              <div class="col-md-8">
                <div class="card-body">
                   
                    <form action="/user/{{auth()->user()->id}}"   method="POST" enctype="multipart/form-data">
                        @method("PUT") 
                        @csrf

                        
                          
                    <p class="card-text fw-bold">Name :</p>
                    <p class="card-text mt-1"><small class="text-muted">
                        <input class="form-control shadow-sm border-0" type="text" value="{{auth()->user()->name}}" aria-label="Disabled input example" name="name"></small></p>
                <br>
                    <p class="card-text fw-bold"> Email : </p>
                    <p class="card-text mt-1"><small class="text-muted">                          
                          <input class="form-control shadow-sm border-0" type="email" value="{{auth()->user()->email}}" aria-label="Disabled input example" name="email" ></small></p>
                </small>
            <br>
                <p class="card-text fw-bold"> Phone : </p>
                <p class="card-text mt-1"><small class="text-muted">                          
                      <input class="form-control shadow-sm border-0" type="text" value="{{auth()->user()->phone}}" aria-label="Disabled input example" name="phone" ></small></p>
            </small>
            <br>
            <p class="card-text fw-bold"> Regoin : </p>
            <p class="card-text mt-1"><small class="text-muted"> 
                <select class="form-select mt-1" aria-label="Default select example"     name="region" required>
                    <option value="{{auth()->user()->region}}">{{auth()->user()->region}}</option>
                    <option value="Cairo">Cairo</option>
                    <option value="Gizeh">Gizeh</option>
                    <option value="Alexandria">Alexandria</option>
                    <option value="Suez">Suez</option>
                    <option value="Luxor">Luxor</option>
                    <option value="Asyut">Asyut</option>
                    <option value="Aswan">Aswan</option>
                    <option value="Damanhur">Damanhur</option>
                    <option value="Sohag">Sohag</option>
                    <option value="Fayyum">Fayyum</option>
                    <option value="Zagazig">Zagazig</option>
                    
                  </select>
                



                  {{-- <input class="form-control shadow-sm border-0" type="text" value="{{auth()->user()->region}}" aria-label="Disabled input example" name="region" ></small></p> --}}
        </small>
            
            
            </p>
            <input  id="photo" type="file"   name="photo"  placeholder="update photo"    class="mt-4"  />

                <button type="submit" class="btn btn-dark mt-4 ms-4">Update</button> 

            </form>
                    </div>
              </div>
            </div>
          </div>
    </div>
</div>
                     
                      
             
           @endif
 <br>          
<hr>
<br>

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-section-border />
            @endif

          

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>
{{-- </x-app-layout> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

@endsection
 