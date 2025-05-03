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

    <title>Log in</title>
</head>
<body style="overflow-x: hidden;background-color: rgb(243 244 246 / var(--tw-bg-opacity, 1));">
<x-guest-layout>
    <div class=" container  mt-4"  >
        <div class="row"   >
            <x-validation-errors class="mb-3" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}"  style="display: inline"/>
                <span style="color: rgb(239, 130, 130);display:inline"> * </span>
                <x-input id="email" class="block mt-1 w-full" type="email" name="email"   required autofocus autocomplete="username"   />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}"  style="display: inline"/>
                <span style="color: rgb(239, 130, 130);display:inline"> * </span>
                <x-input id="password" class="  mt-1 w-full" type="password" name="password" required autocomplete="current-password"  />
                <i class="bi bi-emoji-heart-eyes-fill test" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>

            </div>

         

            <div class="flex items-center justify-start mt-4 mb-4">
             

                <x-button class="ms-4 me-4" style="background-color: #2796AD">
                    &nbsp;&nbsp;  {{ __('Sign in') }}&nbsp;&nbsp;&nbsp;
                </x-button>
        <a class="btn btn-primary   ms-4" href="/register" role="button">Sign Up</a>

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
