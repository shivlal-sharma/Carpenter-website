<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="icon" type="image/jpg" href="/images/logo.jpg">
    <link rel="stylesheet" href="{{asset('css/user/navbar.css')}}">
</head>
<body>
    <div class="container">
        <ul>
            <a href="{{route('dashboard')}}"><img class="image" src="/images/logo.jpg" alt="Sharma Furniture"></a>
            <li><a href="{{route('user-info')}}">Users</a></li>
            <li><a href="{{route('contact-info')}}">Contacts</a></li>
            <li><a href="{{route('userAdd')}}">Add User</a></li>
            <li><a href="{{route('contactAdd')}}">Add Contact</a></li>
            <li><a href="{{route('userTrashView')}}">User Trashed</a></li>
            <li><a href="{{route('contactTrashView')}}">Contact Trashed</a></li>
            
        </ul>
    </div>
</body>
</html>