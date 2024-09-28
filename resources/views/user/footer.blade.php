<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <link rel="icon" type="image/png" href="/images/brand_logo.png" >
    <link rel="stylesheet" href="{{asset('css/user/footer.css')}}" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" >
</head>
<body>
    <div class="footerBox">
        <div class="footer">
            <div class="about-menu">
                <h2>Menu</h2>
                <a href="{{route('home')}}">Home</a>
                <a href="{{route('about')}}">About</a>
                <a href="{{route('service')}}">Service</a>
                <a href="{{route('contact')}}">Contact</a>
                @if(session()->has('user_id'))
                <a href="{{route('logout')}}">Logout</a>
                @else
                <a href="{{route('register')}}">Register</a>
                <a href="{{route('login')}}">Login</a>
                @endif
            </div>
            <div class="about-contact">
                <h2>Contact Us</h2>
                <p><i class="fa-solid fa-phone"></i> <a href="tel:+911234567890">+91 1234567890</a></p>
                <p><i class="fa-solid fa-envelope"></i> <a href="mailto:sharmafurniture@gmail.com">sharmafurniture@gmail.com</a></p>
                <p><i class="fa-solid fa-location"></i> <a href="https://www.google.com/maps?q=Mankhurd,+Maharashtra+Nagar" target="_blank">Mankhurd, Maharashtra Nagar</a></p>
            </div>
            <div class="about-social">
                <h2>Follow Us</h2>
                <a href="https://www.facebook.com/profile.php?id=100042969632345"><img src="/images/Facebook.png" alt="Facebook"></a>
                <a href="https://www.instagram.com/_.n482"><img src="/images/Instagram.png" alt="Instagram"></a>
                <a href="https://in.linkedin.com/in/shivlal-kumar-sharma"><img src="/images/LinkedIn.png" alt="LinkedIn"></a>
                <a href="https://x.com/Shivlal85478071"><img src="/images/x.png" alt="X"></a>
            </div>
        </div>
        <p id="copyright"> © @php echo date('Y') @endphp Sharma Furniture.&nbsp;All rights reserved.</p>
    </div>
</body>
</html>