<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="icon" type="image/png" href="/images/logo.png">
    <link rel='stylesheet' href='{{asset("css/user/register.css")}}'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css'>
</head>
<body>
    @include('user.navbar')
    
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
        <form action="{{route('adminResetPassword')}}" method='post' onsubmit="return validate()">
            <div class="box"><span class="heading">Reset Password</span></div>
            @csrf
            <input type="hidden" name="urlEncodeToken" value="{{$urlEncodeToken}}">
            <div class="input">
                <input type="password" name='password' id="password" placeholder="Enter your password" onkeyup="check2(this.value)" required autofocus autocomplete="off">
                <i id="show" class="fa-sharp fa-solid fa-eye-slash"></i>
                <p class="alert"></p>
                <p class="alert"></p>
            </div>
            <div class="input">
                <input type="password" name='password_confirmation' placeholder="Enter confirm password" onkeyup="check3(this.value)" required autofocus autocomplete="off">
                <p class="alert">
                    @foreach($errors->all() as $error)
                    {{$error}}
                    @endforeach
                </p>
            </div>
            <button type="submit">Reset Password</button>
            <p>Are you Admin ?<a href="{{route('admin_sign_in')}}">Login</a></p>
        </form>
    </div>

    <script src="{{asset('js/register.js')}}"></script>
</body>
</html>