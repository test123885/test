<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  
      <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <script src="{{URL::asset('/js/jquery-3.3.1.min.js')}}"></script> 

    <link rel="stylesheet" href=" {{ URL::asset('css/style.css') }} " >
    <script src="{{URL::asset('/js/jquery-3.3.1.min.js')}}"></script> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
</head>
<body>




    
    <script src="https://js.stripe.com/v3"></script>

    <form action="{{ route('payment.process') }}" method="POST" id="payment-form">
        @csrf
        <div id="card-element"></div>
        <button type="submit">ادفع الآن</button>
    </form>

    
    <script>
        var stripe = Stripe("{{ env('STRIPE_KEY') }}");
        var elements = stripe.elements();
        var card = elements.create("card");
        card.mount("#card-element");
    
        document.querySelector("#payment-form").addEventListener("submit", function(event) {
            event.preventDefault();
    
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    console.log(result.error.message);
                } else {
                    fetch("{{ route('checkout.process') }}", { 
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ stripeToken: result.token.id }) // إرسال رمز الدفع إلى السيرفر
                    }).then(response => response.json())
                      .then(data => console.log(data));
                }
            });
        });
    </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/scrollreveal"></script>
  
      <script src="{{ URL::asset('js/main.js') }}"></script>
      <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
      integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
      crossorigin="anonymous"
    ></script>
</body>
</html>