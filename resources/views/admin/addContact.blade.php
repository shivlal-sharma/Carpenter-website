<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Contact</title>
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
        <form action="{{route('contactAdd')}}" method='post' onsubmit="return validate()">
            <div class="box"><span class="heading">Contact Us</span></div>
            @csrf
            <div class="input">
                <input type="text" name='name' value="{{old('name')}}" placeholder="Enter your name" required autofocus>
                <i class="fa-sharp fa-solid fa-user"></i>
            </div>
            <div class="input">
                <input type="text" name='address' value="{{old('address')}}" placeholder="Enter your address" required autofocus>
                <i class="fa-sharp fa-solid fa-location"></i>
            </div>
            <div class="input">
                <input type="email" name='email' value="{{old('email')}}" placeholder="Enter your email" onkeyup="check1(this.value)" required autofocus>
                <i class="fa-sharp fa-solid fa-envelope"></i>
                <p class="alert"></p>
            </div>
            <div class="input">
                <input type="text" name='message' value="{{old('message')}}" placeholder="Enter your message" required autofocus>
                <i class="fa-sharp fa-solid fa-message"></i>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>

    <script src="{{asset('js/register.js')}}"></script>
</body>
</html>