<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Contact</title>
    <link rel="icon" type="image/jpg" href="/images/logo.jpg">
    <link rel='stylesheet' href='{{asset("css/user/register.css")}}'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css'>
    <style>
        body{
            background: url('/images/user/bg3.jpg') no-repeat center center/cover;
        }

        button{
            color:yellow;
            border:1px solid yellow;
        }
    </style>
</head>
<body>
    @include('admin.navbar')
    
    <div class="content">

        @if(session()->has('success'))
        <div class="message">
            {{session()->get('success')}}
            <i class="fa-sharp fa-solid fa-xmark" onclick="remove(this)"></i>
        </div>
        @endif

        @if(session()->has('error'))
        <div class="message">
            {{session()->get('error')}}
            <i class="fa-sharp fa-solid fa-xmark" onclick="remove(this)"></i>
        </div>
        @endif
        <form action="{{route('contactEdit',$contact->contact_id)}}" method='post' onsubmit="return validate()">
            <div class="box"><span class="heading">Contact Us</span></div>
            @csrf
            <div class="input">
                <input type="text" name='name' value="{{$contact->name}}" placeholder="Enter your name" required autofocus autocomplete="off">
                <i class="fa-sharp fa-solid fa-user"></i>
            </div>
            <div class="input">
                <input type="text" name='address' value="{{$contact->address}}" placeholder="Enter your address" required autofocus autocomplete="off">
                <i class="fa-sharp fa-solid fa-location"></i>
            </div>
            <div class="input">
                <input type="email" name='email' value="{{$contact->email}}" placeholder="Enter your email" onkeyup="check1(this.value)" required autofocus autocomplete="off">
                <i class="fa-sharp fa-solid fa-envelope"></i>
                <p class="alert"></p>
            </div>
            <div class="input">
                <input type="text" name='message' value="{{$contact->message}}" placeholder="Enter your message" required autofocus autocomplete="off">
                <i class="fa-sharp fa-solid fa-message"></i>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>

    <script src="{{asset('js/register.js')}}"></script>
</body>
</html>