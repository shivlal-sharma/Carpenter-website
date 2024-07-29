<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="icon" type="image/jpg" href="/images/logo.jpg">
    <link rel="stylesheet" href="{{asset('css/user/navbar.css')}}">
</head>
<body>
    <div class="container">
        <ul>
            <img class="image" src="/images/logo.jpg" alt="Sharma Furniture">
            <li><a href="{{route('home')}}">Home</a></li>
            <li><a href="{{route('about')}}">About</a></li>
            <li><a href="{{route('service')}}">Service</a></li>
            <li><a href="{{route('contact')}}">Contact</a></li>
            @if(session()->has('loggedId'))
            <li><a href="{{route('logout')}}">Logout</a></li>
            @else
            <li><a href="{{route('register')}}">Register</a></li>
            <li><a href="{{route('login')}}">Login</a></li>
            @endif
        </ul>
    </div>
</body>
</html>