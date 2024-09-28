<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" type="image/png" href="/images/logo.png">
    <link rel="stylesheet" href="{{asset('css/admin/dashboard.css')}}">
</head>
<body>
    @include('admin.header')
    <main>
        <section class="overview-cards">
            <div class="card">Total Users: <span>{{number_format($total_users)}}</span></div>
            <div class="card">Active Users: <span>{{number_format($total_active_users)}}</span></div>
            <div class="card">Inactive Users: <span>{{number_format($total_inactive_users)}}</span></div>
            <div class="card">Total Trashed Users: <span>{{number_format($total_trashed_users)}}</span></div>
            <div class="card">Total Admins: <span>{{number_format($total_admins)}}</span></div>
            <div class="card">Active Admins: <span>{{number_format($total_active_admins)}}</span></div>
            <div class="card">Inactive Admins: <span>{{number_format($total_inactive_admins)}}</span></div>
            <div class="card">Total Trashed Admins: <span>{{number_format($total_trashed_admins)}}</span></div>
            <div class="card">Total Contacts: <span>{{number_format($total_contacts)}}</span></div>
            <div class="card">Total Trashed Contacts: <span>{{number_format($total_trashed_contacts)}}</span></div>
        </section>
    </main>
</body>
</html>