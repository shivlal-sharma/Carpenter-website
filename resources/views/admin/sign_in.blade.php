<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="icon" type="image/png" href="/images/logo.png">
    <link rel='stylesheet' href='{{asset("css/user/register.css")}}'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css'>
</head>
<body>
    @include('admin.header')
    
    <div class="content">
        @if(session()->has('success'))
        <div class="message" id="success">
            {{session()->get('success')}}
            <i class="fa-sharp fa-solid fa-xmark" onclick="remove(this)"></i>
        </div>
        @endif

        @if(session()->has('error'))
        <div class="message" id="error">
            {{session()->get('error')}}
            <i class="fa-sharp fa-solid fa-xmark" onclick="remove(this)"></i>
        </div>
        @endif

        <form action="{{route('adminLogin')}}" method='post'>
            <div class="box"><span class="heading">Sign In</span></div>
            @csrf
            <div class="input">
                <input type="email" name='email' placeholder="Enter your email" required autofocus>
                <i class="fa-sharp fa-solid fa-envelope"></i>
            </div>
            <div class="input">
                <input type="password" name='password' id="password" placeholder="Enter your password" required autofocus>
                <i id="show" class="fa-sharp fa-solid fa-eye-slash"></i>
            </div>
            <div class="input">
                <a href="{{route('forgetPassword')}}">Forget Password ?</a>
            </div>
            <button type="submit">Sign In</button>
        </form>
    </div>

    <script src="{{asset('js/register.js')}}"></script>
</body>
</html>