<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>open book</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            overflow: hidden; /* يمنع التمرير في الصفحة */
            height: 100%;
        }
        #pdf-container {
            width: 100vw;
            height: 100vh;
        }
    </style>
    
</head>
<body >
        
<div id="pdf-container">
    <object data="{{URL::asset('/pdf/'.$data)}}" type="application/pdf" width="100%" height="100%"></object>
</div>

</body>
</html>
