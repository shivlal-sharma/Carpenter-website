<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" type="image/jpg" href="/images/logo.jpg">
    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            display:flex;
            flex-direction:column;
            height: 100vh;
            background:url('/images/admin/bg2.jpg') no-repeat center center/cover;
        }

        .box{
            display:flex;
            flex-direction:column;
            font-size:1.1rem;
            margin-inline:auto;
            margin-block:auto;
            padding:10px;
        }

        .data{
            color:#fff;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            border:2px solid #00ffff;
            border-radius:5px;
            margin-block:10px;
            padding:5px 10px;
        }

        #users{
            color:#0f0;
            font-size:1.5rem;
        }

        #contacts{
            color:#ff0;
            font-size:1.5rem;
        }

        #users-trashed{
            color:pink;
            font-size:1.5rem;
        }

        #contacts-trashed{
            color:#ffcc11;
            font-size:1.5rem;
        }

        b{
            font-size:1.3rem;
        }
    </style>
</head>
<body>
    @include('admin.navbar')
        <div class="box">
            <div class="data"><p id="users">Total Users </p><b>{{$users}}</b></div>
            <div class="data"><p id="contacts">Total Contacts </p><b>{{$contacts}}</b></div>
            <div class="data"><p id="users-trashed">Total Users In Trashed </p><b>{{$usersTrashed}}</b></div>
            <div class="data"><p id="contacts-trashed">Total Contacts In Trashed </p><b>{{$contactsTrashed}}</b></div>
        </div>
</body>
</html>