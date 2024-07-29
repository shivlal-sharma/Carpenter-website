<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="icon" type="image/jpg" href="/images/logo.jpg">
    <link rel="stylesheet" href="{{asset('css/user/home.css')}}">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css'>
</head>
<body>
    @include('user.navbar')
    <div class="box">
        <h2>@if($data) Welcome - {{$data->name}} @else Welcome @endif</h2>
        <p>At <b>Sharma Furniture</b>, we specialize in bringing your woodworking dreams to life. With <b>25 Years</b> of experience in the industry, we blend traditional craftsmanship with modern techniques to deliver exceptional results tailored to your needs.</p>
    </div>

    <script>
        function remove(e){
            let parent = e.parentElement;
            parent.remove();
        }
    </script>
</body>
</html>