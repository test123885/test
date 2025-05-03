@extends('nav')
@section('mynav')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <link rel="stylesheet" 
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <title>Register</title> 
</head>
<body style="overflow-x: hidden;background-color: rgb(243 244 246 / var(--tw-bg-opacity, 1));">
<x-guest-layout>
    <div class=" container  mt-4"  >
        <div class="row"   >
            <x-validation-errors class="mb-3" />
    
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}"  style="display: inline"/>
                <span style="color: rgb(239, 130, 130);display:inline"> * </span>
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}"  style="display: inline"/>
                <span style="color: rgb(239, 130, 130);display:inline"> * </span>
                <x-input id="email" class="block mt-1 w-full" type="email" name="email"   required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="passwords" value="{{ __('Password') }}"  style="display: inline"/>
                <span style="color: rgb(239, 130, 130);display:inline"> * </span>
                <x-input id="passwords" class="  mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                             <i class="bi bi-emoji-heart-eyes-fill test" id="togglePassword2" style="margin-left: -30px; cursor: pointer;"></i>
           
            </div>
            <div class="mt-4">
                <x-label for="phone" value="{{ __('Phone') }}"  style="display: inline"/>
                <span style="color: rgb(239, 130, 130);display:inline"> * </span>
                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autofocus autocomplete="name" />
            </div>
            <div class="mt-4">
                <x-label for="region" value="{{ __('Region') }}"  style="display: inline"/>
                <span style="color: rgb(239, 130, 130);display:inline"> * </span>
                <select class="form-select mt-1" aria-label="Default select example"     name="region" :value="old('region')" required>
                    
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
                {{-- <x-input id="region" class="block mt-1 w-full" type="text" name="region" :value="old('region')" required autofocus autocomplete="name" /> --}}
            </div>
            <div class="mt-4">
                <x-label for="age" value="{{ __('Age') }}"  style="display: inline"/>
               
               <span style="color: rgb(239, 130, 130);display:inline"> * </span>  
               <output id="num" class="ms-4">20</output><br>
                <input type="range" value="20" min="10"  max="100" oninput="num.value = this.value" name="age" class="form-range ">
            </div> 
            <div class="mt-4">
                <x-label for="gendar" value="{{ __('Gendar') }}" style="font-size: larger;" class="mb-3" style="display: inline"/>
                <span style="color: rgb(239, 130, 130);"> * </span><br>
                <input type="radio" id="male" name="gendar" value="male">
                <label for="male">Male</label>
                <input type="radio" id="female" name="gendar" value="female" style="margin-left: 40px">
                <label for="female">Female</label><br><br>
             </div>
            <div class="mt-4">
                <x-label for="role" value="{{ __('Role') }}" style="font-size: larger;" class="mb-3" style="display: inline"/>
                <span style="color: rgb(239, 130, 130);"> * </span><br>
                <input type="radio" id="user" name="role" value="user">
                <label for="user">User</label>
                <input type="radio" id="author" name="role" value="author" style="margin-left: 40px">
                <label for="author">Author</label><br><br>
             </div>
             <div class="mt-4">
                <x-label for="photo" value="{{ __('Photo') }}"  style="display: inline"/>
            <input  id="photo" type="file"   name="photo"  placeholder="chose photo"    class="block mt-1 w-full ms-4" />
            {{-- <input id="password" class="  mt-1 w-full" type="password" name="password" required autocomplete="new-password" /> --}}
                
                {{-- <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" /> --}}
            </div>
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-start mt-4 ms-4 mb-4">
               

                <x-button  style="background-color: #2796AD">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </div>
</div>
 </x-guest-layout>
 <br>
<div class="mt-4 ">
   
   @include('user.subscription')

</div>
<script src="{{URL::asset('/js/test.js')}}"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
@endsection
