<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
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
        
        <form action="{{route('contactStore')}}" method='post'>
            <div class="box"><span class="heading">Contact Us</span></div>
            @csrf
            <div class="input">
                <input type="text" name='name' placeholder="Enter your name" required autofocus>
                <i class="fa-sharp fa-solid fa-user"></i>
            </div>
            <div class="input">
                <input type="text" name='address' placeholder="Enter your address" required autofocus>
                <i class="fa-sharp fa-solid fa-location"></i>
            </div>
            <div class="input">
                <input type="email" name='email' placeholder="Enter your email" required autofocus>
                <i class="fa-sharp fa-solid fa-envelope"></i>
                <p class="alert">
                    @error('email')
                        {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="input">
                <input type="text" name='message' placeholder="Enter your message" required autofocus>
                <i class="fa-sharp fa-solid fa-message"></i>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>

    <script src="{{asset('js/register.js')}}"></script>
</body>
</html>