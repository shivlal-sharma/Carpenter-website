<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/jpg" href="/images/logo.jpg">
    <link rel='stylesheet' href='{{asset("css/user/register.css")}}'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css'>
    <style>
        body{
            background: url('/images/user/bg1.jpg') no-repeat center center/cover;
        }
    </style>
</head>
<body>
    @include('user.navbar')
   
    <div class="content">
        @if(session()->has('success'))
        <div id="success" class="message">
            {{session()->get('success')}}
            <i class="fa-sharp fa-solid fa-xmark" onclick="remove(this)"></i>
        </div>
        @endif

        @if(session()->has('error'))
        <div id="error" class="message">
            {{session()->get('error')}}
            <i class="fa-sharp fa-solid fa-xmark" onclick="remove(this)"></i>
        </div>
        @endif
        <form action="{{route('loginStore')}}" method='post'>
            <div class="box"><span class="heading">Login</span></div>
            @csrf
            <div class="input">
                <input type="email" name='email' placeholder="Enter your email" required outofocus>
                <i class="fa-sharp fa-solid fa-envelope"></i>
            </div>
            <div class="input">
                <input type="password" name='password' id="password" placeholder="Enter your password" required>
                <i id="show" class="fa-sharp fa-solid fa-eye"></i>
            </div>
            <div class="input">
                <a href="/forget">Forget Password ?</a>
            </div>
            <button type="submit">Sign In</button>
            <p>Don't have an account ?<a href="/register">Register</a></p>
        </form>
    </div>
    <script src="{{asset('js/register.js')}}"></script>
</body>
</html>