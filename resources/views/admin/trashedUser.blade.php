<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trashed User</title>
    <link rel="icon" type="image/png" href="/images/logo.png">
    <link rel="stylesheet" href="{{asset('css/admin/users.css')}}">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css'>
</head>
<body>
    @include('admin.header')
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

        @if($usersData->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th>Users_Id</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Email Verified At</th>
                    <th>Created At</th>
                    <th>Deleted At</th>
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
                    <td>{{$user->status}}</td>
                    <td>{{$user->email_verified_at}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->deleted_at}}</td>
                    <td>
                        <a id="trash" href="{{route('userForceDelete',$user->users_id)}}">Delete</a>
                        <a id="edit" href="{{route('userRestore',$user->users_id)}}">Restore</a>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
        @else
            <h2>There is no Trashed User</h2>
        @endif
    </div>

    <script>
        function remove(e){
            let parent = e.parentElement;
            parent.remove(); 
        }
    </script>
</body>
</html>