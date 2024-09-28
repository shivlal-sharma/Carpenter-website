<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Recovery</title>
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
        <div id="error" class="message">
            {{session()->get('error')}}
            <i class="fa-sharp fa-solid fa-xmark" onclick="remove(this)"></i>
        </div>
        @endif

        <form action="{{route('adminForgetPassword')}}" method='post'>
            <div class="box"><span class="heading">Verify Email</span></div>
            @csrf
            <div class="input">
                <input type="email" name='email' placeholder="Enter your email" onkeyup="check1(this.value)" required outofocus>
                <i class="fa-sharp fa-solid fa-envelope"></i>
                <p class="alert">
                    @foreach($errors->all() as $error)
                        {{$error}}
                    @endforeach
                </p>
            </div>
            <button type="submit">Next</button>
            <p>Are you Admin ?<a href="{{route('admin_sign_in')}}">Sign In</a></p>
        </form>
    </div>

    <script src="{{asset('js/register.js')}}"></script>
</body>
</html>