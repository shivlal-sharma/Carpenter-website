<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Walls</title>
    <link rel="icon" type="image/png" href="/images/brand_logo.png">
    <link rel="stylesheet" href="{{asset('css/user/designs.css')}}" >
</head>
<body>
    @include('user.navbar')
    <div class="box">
        <div class="images">
            <img src="/images/user/wall1.jpg" alt="Wall Design">
            <img src="/images/user/wall2.jpg" alt="Wall Design">
            <img src="/images/user/wall3.jpg" alt="Wall Design">
            <img src="/images/user/wall4.avif" alt="Wall Design">
            <img src="/images/user/wall4.webp" alt="Wall Design">
            <img src="/images/user/wall5.jpg" alt="Wall Design">
            <img src="/images/user/wall6.jpg" alt="Wall Design">
            <img src="/images/user/wall7.avif" alt="Wall Design">
        </div>
        <div class="content">
            <p>If you want the design according to you</p>
            <p>Then we can also design according to you</p>
        </div>
    </div>
    @include('user.footer')
</body>
</html>