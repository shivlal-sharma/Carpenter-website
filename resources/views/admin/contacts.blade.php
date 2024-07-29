<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts-Info</title>
    <link rel="icon" type="image/jpg" href="/images/logo.jpg">
    <link rel="stylesheet" href="{{asset('css/admin/users.css')}}">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css'>
    <style>
        body{
            background: url('/images/admin/bg3.jpg') no-repeat center center/cover;
        }
    </style>
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
                    <th>Contact_Id</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Updated_at</th>
                    <th>Action</th>
                </tr>
            </thead>
            @foreach($contactsData as $contact)
            <tbody>
                <tr>
                    <td>{{$contact->contact_id}}</td>
                    <td>{{$contact->name}}</td>
                    <td>{{$contact->address}}</td>
                    <td>{{$contact->email}}</td>
                    <td>{{$contact->message}}</td>
                    <td>{{$contact->updated_at}}</td>
                    <td>
                        <a id="trash" href="{{route('contactTrash',$contact->contact_id)}}">Trash</a>
                        <a id="edit" href="{{route('contactEditPage',$contact->contact_id)}}">Edit</a>
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