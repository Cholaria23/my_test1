<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Luna - Admin Dashboard">
    <meta name="author" content="mrKorg">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,AngularJS,Angular,Angular2,jQuery,CSS,HTML,RWD,Dashboard">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('frontend.layouts.parts.icons')

    <title>Luna - Admin Dashboard</title>

    <!-- Main styles for this application -->
    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet">

</head>

<body class="app header-fixed aside-menu-fixed aside-menu-hidden">
<header class="app-header navbar">
    <button class="navbar-toggler mobile-sidebar-toggler hidden-lg-up" type="button">☰</button>
    <a class="navbar-brand" href="#"></a>
    <ul class="nav navbar-nav hidden-md-down">
        <li class="nav-item">
            <a class="nav-link navbar-toggler sidebar-toggler" href="#">☰</a>
        </li>
    </ul>
    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item" style="padding: 0 20px 0 40px">
            <a href="{{ route('home') }}" class="btn btn-success" target="_blank">
                Go to site
            </a>
            <a href="{{ route('logout') }}" class="btn btn-danger">
                Logout
            </a>
        </li>
    </ul>
</header>

<div class="app" id="admin">
    <div class="app-body">
        <div class="sidebar">
            <nav class="sidebar-nav">
                <vue-menu></vue-menu>
            </nav>
        </div>

        <main class="main" style="padding-top: 1.5rem">

            <div class="container-fluid">

                <div class="animated fadeIn">
                    <router-view :key="$route.fullPath"></router-view>
                </div>

            </div>

        </main>

    </div>
</div>

<script>
    window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?>
</script>
<script src="{{ asset('backend/js/app.js') }}"></script>

</body>

</html>