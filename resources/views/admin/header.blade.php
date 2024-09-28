<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="icon" type="image/png" href="/images/logo.png">
    <link rel="stylesheet" href="{{asset('css/admin/header.css')}}">
</head>
<body>
    <div class="header">
        <div class="navbar-left">
            <span id="hamburger">&#9776;</span>
            <a href="{{route('privacy&policy')}}"><img class="image" src="/images/logo.png" alt="Sharma Furniture"></a>
        </div>
        <div class="navbar-center">
            <a href="{{route('dashboard')}}">DashBoard</a>
            <a href="{{route('user-info')}}" class="user">Users</a>
            <a href="{{route('contact-info')}}" class="contact">Contacts</a>
            <a href="{{route('admin-info')}}" class="admin">Admins</a>
            <a href="{{route('userAdd')}}" class="add-user">Add User</a>
            <a href="{{route('contactAdd')}}" class="add-contact">Add Contact</a>
            <a href="{{route('adminAdd')}}" class="add-admin">Add Admin</a>
            <a href="{{route('userTrashView')}}" class="trashed-user">Trashed User</a>
            <a href="{{route('contactTrashView')}}" class="trashed-contact">Trashed Contact</a>
        </div>
        <div class="navbar-right">
            @if(session()->has('admin_id'))
            <a href="{{route('adminLogout')}}" class="logout">Logout</a>
            @else
            <a href="{{route('admin_sign_in')}}" class="login">Login</a>
            @endif
        </div>
    </div>
    <div class="modal">
        <div class="sidebar">
            <span id="cancel">&times;</span>
            <a href="{{route('dashboard')}}">DashBoard</a>
            <a href="{{route('user-info')}}">Users</a>
            <a href="{{route('contact-info')}}">Contacts</a>
            <a href="{{route('admin-info')}}" class="admin">Admins</a>
            <a href="{{route('userAdd')}}">Add User</a>
            <a href="{{route('contactAdd')}}">Add Contact</a>
            <a href="{{route('adminAdd')}}" class="add-admin">Add Admin</a>
            <a href="{{route('userTrashView')}}">User Trashed</a>
            <a href="{{route('contactTrashView')}}">Contact Trashed</a>
            <a href="{{route('adminTrashView')}}">Trashed Admin</a>
            @if(session()->has('admin_id'))
            <a href="{{route('adminLogout')}}" class="logout">Logout</a>
            @else
            <a href="{{route('admin_sign_in')}}" class="login">Login</a>
            @endif
        </div>
    </div>

    <script src="{{asset('js/sidebar.js')}}"></script>
</body>
</html>