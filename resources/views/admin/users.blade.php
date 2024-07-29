<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users-Info</title>
    <link rel="icon" type="image/jpg" href="/images/logo.jpg">
    <link rel="stylesheet" href="{{asset('css/admin/users.css')}}">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css'>
</head>
<body>
    @include('admin.navbar')
    <div class="content">
        @if(session()->has('success'))
        <div class="success">
            {{session()->get('success')}}
            <i class="fa-sharp fa-solid fa-xmark" onclick="remove(this)"></i>
        </div>
        @endif

        @if(session()->has('error'))
        <div class="error">
            {{session()->get('error')}}
            <i class="fa-sharp fa-solid fa-xmark" onclick="remove(this)"></i>
        </div>
        @endif
        <table border="1">
            <thead>
                <tr>
                    <th>Users_Id</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Updated_at</th>
                    <th>Action</th>
                </tr>
            </thead>
            @foreach($usersData as $user)
            <tbody>
                <tr>
                    <td>{{$user->users_id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->address}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->updated_at}}</td>
                    <td>
                        <a id="trash" href="{{route('userTrash',$user->users_id)}}">Trash</a>
                        <a id="edit" href="{{route('userEditPage',$user->users_id)}}">Edit</a>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>

    <script>
        function remove(e){
            let parent = e.parentElement;
            parent.remove(); 
        }
    </script>
</body>
</html>