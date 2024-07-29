<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beds</title>
    <link rel="icon" type="image/png" href="/images/brand_logo.png">
    <link rel="stylesheet" href="{{asset('css/user/designs.css')}}" >
</head>
<body>
    @include('user.navbar')
    <div class="box">
        <div class="images">
            <img src="/images/user/bed1.jpg" alt="Bed Design">
            <img src="/images/user/bed2.webp" alt="Bed Design">
            <img src="/images/user/bed3.jpg" alt="Bed Design">
            <img src="/images/user/bed4.jpg" alt="Bed Design">
            <img src="/images/user/bed5.avif" alt="Bed Design">
            <img src="/images/user/bed6.jpg" alt="Bed Design">
            <img src="/images/user/bed7.jpg" alt="Bed Design">
            <img src="/images/user/bed8.jpg" alt="Bed Design">
        </div>
        <div class="content">
            <p>If you want the design according to you</p>
            <p>Then we can also design according to you</p>
        </div>
    </div>
    @include('user.footer')
</body>
</html>