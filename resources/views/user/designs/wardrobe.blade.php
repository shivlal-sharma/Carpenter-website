<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wardrobes</title>
    <link rel="icon" type="image/png" href="/images/brand_logo.png">
    <link rel="stylesheet" href="{{asset('css/user/designs.css')}}" >
</head>
<body>
    @include('user.navbar')
    <div class="box">
        <div class="images">
            <img src="/images/user/wordrobe1.jpg" alt="Wardrobe">
            <img src="/images/user/wordrobe2.jpg" alt="Wardrobe">
            <img src="/images/user/wordrobe3.jpg" alt="Wardrobe">
            <img src="/images/user/wordrobe4.jpg" alt="Wardrobe">
            <img src="/images/user/wordrobe5.avif" alt="Wardrobe">
            <img src="/images/user/wordrobe6.jpg" alt="Wardrobe">
            <img src="/images/user/wordrobe7.jpg" alt="Wardrobe">
            <img src="/images/user/wordrobe8.jpg" alt="Wardrobe">
        </div>
        <div class="content">
            <p>If you want the design according to you</p>
            <p>Then we can also design according to you</p>
        </div>
    </div>
    @include('user.footer')
</body>
</html>