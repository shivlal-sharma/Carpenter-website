<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="icon" type="image/png" href="/images/logo.png">
    <link rel="stylesheet" href="{{asset('css/user/navbar.css')}}">
</head>
<body>
    <div class="header">
        <div class="navbar-left">
            <span id="hamburger">&#9776;</span>
            <a href="{{route('privacy&policy')}}"><img class="image" src="/images/logo.png" alt="Sharma Furniture"></a>
        </div>
        <div class="navbar-center">
            <a href="{{route('home')}}" class="home">Home</a>
            <a href="{{route('about')}}" class="about">About</a>
            <a href="{{route('service')}}" class="service">Service</a>
            <a href="{{route('contact')}}" class="contact">Contact</a>
        </div>
        <div class="navbar-right">
            @if(session()->has('user_id'))
            <a href="{{route('logout')}}" class="logout">Logout</a>
            @else
            <a href="{{route('register')}}" class="register">Register</a>
            <a href="{{route('login')}}" class="login">Login</a>
            @endif
        </div>
    </div>
    <div class="modal">
        <div class="sidebar">
            <span id="cancel">&times;</span>
            <a href="{{route('home')}}" class="home">Home</a>
            <a href="{{route('about')}}" class="about">About</a>
            <a href="{{route('service')}}" class="service">Service</a>
            <a href="{{route('contact')}}" class="contact">Contact</a>
            @if(session()->has('user_id'))
            <a href="{{route('logout')}}" class="logout">Logout</a>
            @else
            <a href="{{route('register')}}" class="register">Register</a>
            <a href="{{route('login')}}" class="login">Login</a>
            @endif
        </div>
    </div>

    <script src="{{asset('js/sidebar.js')}}"></script>
</body>
</html>