<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service</title>
    <link rel="icon" type="image/png" href="/images/logo.png">
    <link rel="stylesheet" href="{{asset('css/user/service.css')}}" >
</head>
<body>
    @include('user.navbar')
    <div class="box">
        <div class="innerBox">
            <div class="work-detail">
                <img src="/images/user/wordrobe1.png" alt="Wardrobe">
                <a href="{{route('wardrobe')}}">View More</a>
            </div>
            <div class="content">
                Transform your living space with a bespoke wardrobe tailored just for you! At <b>Sharma Furniture</b>, we specialize in creating personalized wardrobes that blend functionality with exquisite design.
            </div>
        </div>
        <div class="reverseBox">
            <div class="work-detail">
                <img src="/images/user/bed1.png" alt="Bed">
                <a href="{{route('bed')}}">View More</a>
            </div>
            <div class="content">
                Transform your bedroom into a luxurious retreat with a bespoke bed designed just for you! At <b>Sharma Furniture</b>, we specialize in creating personalized beds that marry comfort with impeccable craftsmanship.
            </div>
        </div>
        <div class="innerBox">
            <div class="work-detail">
                <img src="/images/user/hall1.png" alt="Hall">
                <a href="{{route('hall')}}">View More</a>
            </div>
            <div class="content">
                Transform your hall into a masterpiece of craftsmanship and elegance with <b>Sharma Furniture</b>. We specialize in creating bespoke carpentry solutions that enhance the functionality and beauty of your living or commercial space.
            </div>
        </div>
        <div class="reverseBox">
            <div class="work-detail">
                <img src="/images/user/kitchen1.png" alt="Kitchen">
                <a href="{{route('kitchen')}}">View More</a>
            </div>
            <div class="content">
                Upgrade your culinary space with a bespoke kitchen from <b>Sharma Furniture</b>. Specializing in personalized carpentry solutions, we create kitchens that blend functionality, style, and craftsmanship to exceed your expectations.
            </div>
        </div>
        <div class="innerBox">
            <div class="work-detail">
                <img src="/images/user/dining1.png" alt="Dining Table">
                <a href="{{route('dining')}}">View More</a>
            </div>
            <div class="content">
                Enhance your dining room with a bespoke dining table from <b>Sharma Furniture</b>. Specializing in personalized carpentry solutions, we create tables that combine timeless elegance with exceptional craftsmanship, perfect for gathering friends and family.
            </div>
        </div>
        <div class="reverseBox">
            <div class="work-detail">
                <img src="/images/user/ceil1.png" alt="Ceiling">
                <a href="{{route('ceiling')}}">View More</a>
            </div>
            <div class="content">
                Transform your home or business with a bespoke ceiling creation from <b>Sharma Furniture</b>. Specializing in personalized carpentry solutions, we turn ordinary ceilings into extraordinary architectural statements that enhance your interior's beauty and functionality.
            </div>
        </div>
        <div class="innerBox">
            <div class="work-detail">
                <img src="/images/user/wall2.png" alt="Wall">
                <a href="{{route('wall')}}">View More</a>
            </div>
            <div class="content">
                Elevate your home or office with a bespoke wall creation from <b>Sharma Furniture</b>. Specializing in personalized carpentry solutions, we turn ordinary walls into stunning focal points that redefine interior aesthetics.
            </div>
        </div>
    </div>
    @include('user.footer')
</body>
</html>