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
<body onload="year()">
    <div class="footerBox">
        <div class="footer">
            <div class="about">
                <h2>Menu</h2>
                <p><a href="{{route('home')}}">Home</a></p>
                <p><a href="{{route('about')}}">About</a></p>
                <p><a href="{{route('service')}}">Service</a></p>
                <p><a href="{{route('contact')}}">Contact</a></p>
                <p><a href="{{route('logout')}}">Logout</a></p>
            </div>
            <div class="contact">
                <h2>Contact Us</h2>
                <p><i class="fa-solid fa-phone"></i> +91 1234567890</p>
                <p><i class="fa-solid fa-envelope"></i> sharmafurniture@gmail.com</p>
                <p><i class="fa-solid fa-location"></i> Mankhurd, Maharashtra Nagar</p>
            </div>
            <div class="social">
                <h2>Follow Us</h2>
                <p><a href="https://www.facebook.com/profile.php?id=100042969632345"><img src="/images/Facebook.webp" alt="Facebook"></a></p>
                <p><a href="https://www.instagram.com/_.n482"><img src="/images/Instagram.webp" alt="Instagram"></a></p>
                <p><a href="https://in.linkedin.com/in/shivlal-kumar-sharma"><img src="/images/LinkedIn.png" alt="LinkedIn"></a></p>
                <p><a href="https://x.com/Shivlal85478071"><img src="/images/x.jpg" alt="X"></a></p>
            </div>
        </div>
        <p id="copyright">Copyright &copy; <span></span> All rights are reserved</p>
    </div>

    <script>
        function year(){
            let span = document.getElementsByTagName('span')[0];
            let d = new Date();
            let year = d.getFullYear();
            span.innerText = year;
        }
    </script>
</body>
</html>