<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & FontAwesome -->
    <link rel="stylesheet" href="{{ asset('bootstrap1/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/fontawesome-free-6.7.2-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar {
            height: 100vh;
            width: 220px;
            background-color: #343a40;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            padding-top: 20px;
        }

        .sidebar a {
            color: #ffffff;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            transition: all 0.3s;
        }

        .sidebar a:hover {
            background-color: #ffffff;
            color: #343a40;
        }

        .sidebar .active {
            background-color: #495057;
        }

        .sidebar .sidebar-header {
            text-align: center;
            color: white;
            font-size: 1.4rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .main-content {
            margin-left: 220px;
            padding: 20px;
        }

        .navbar-top {
            background-color: #ffffff;
            border-bottom: 1px solid #dee2e6;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-top h4 {
            margin: 0;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <i class="fa-solid fa-user-shield"></i> Admin dashboard
        </div>
        <a href="#"><i class="fa-solid fa-gauge"></i> Dashboard</a>
        <a href="#"><i class="fa-solid fa-users"></i> Users</a>
        <a href="#"><i class="fa-solid fa-box"></i> Products</a>
        <a href="#"><i class="fa-solid fa-chart-line"></i> Reports</a>
        <a href="#"><i class="fa-solid fa-gear"></i> Settings</a>
        <a href="#" class="text-danger"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="navbar-top">
            <h4>@yield('title')</h4>
            <div>
                <i class="fa-solid fa-bell"></i>
                <i class="fa-solid fa-user ms-3"></i>
            </div>
        </div>

        <div class="container mt-4">
            @yield('content')
        </div>
    </div>

</body>
</html>
