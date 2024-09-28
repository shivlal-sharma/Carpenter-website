<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admins</title>
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

        @if(!$adminsData->isEmpty())
        <table>
            <thead>
                <tr>
                    <th>Admin Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Email Verified At</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                </tr>
            </thead>
            @foreach($adminsData as $admin)
            <tbody>
                <tr>
                    <td>{{$admin->admin_id}}</td>
                    <td>{{$admin->name}}</td>
                    <td>{{$admin->email}}</td>
                    <td>{{$admin->status}}</td>
                    <td>{{$admin->email_verified_at}}</td>
                    <td>{{$admin->created_at}}</td>
                    <td>{{$admin->updated_at}}</td>
                    <td>
                        <a id="trash" href="{{route('adminTrash',$admin->admin_id)}}">Trash</a>
                        <a id="edit" href="{{route('adminEditPage',$admin->admin_id)}}">Edit</a>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
        @else
            <h2>There is no Admin</h2>
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