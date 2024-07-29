<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="icon" type="image/png" href="/images/brand_logo.png">
    <link rel="stylesheet" href="{{asset('css/user/about.css')}}" >
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
        <div class="box">
            <a href="{{route('wardrobe')}}"><img src="/images/user/wordrobe2.jpg" title="View More" alt="Wardrobe"></a>
            <a href="{{route('bed')}}"><img src="/images/user/bed1.jpg" title="View More" alt="Bed"></a>
            <a href="{{route('hall')}}"><img src="/images/user/hall1.jpg" title="View More" alt="Hall"></a>
            <a href="{{route('kitchen')}}"><img src="/images/user/kitchen1.jpg" title="View More" alt="Kitchen"></a>
            <a href="{{route('dining')}}"><img src="/images/user/dining1.webp" title="View More" alt="Dining table"></a>
            <a href="{{route('ceiling')}}"><img src="/images/user/ceil1.jpg" title="View More" alt="Ceiling"></a>
            <a href="{{route('wall')}}"><img src="/images/user/wall1.jpg" title="View More" alt="Wall"></a>
        </div>
    </div>
    @include('user.footer')

    <script>
        function remove(e){
            let parent = e.parentElement;
            parent.remove();
        }
    </script>
</body>
</html>