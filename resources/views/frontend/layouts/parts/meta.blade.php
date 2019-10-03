<title>@yield('title', 'STALEKS')</title>
{{-- <meta name="title" content="@yield('title', 'STALEKS')"> --}}

<meta name="description" content="@yield('description', 'STALEKS')">
<meta name="keywords" content="@yield('keywords', 'STALEKS')">

<meta property="og:site_name" content="STALEKS">
<meta property="og:url" content="{{ request()->fullUrl() }}">

<meta property="og:title" content="@yield('title', 'STALEKS')">
<meta property="og:description" content="@yield('description', 'STALEKS')">
<meta property="og:image" content="@yield('image', asset('frontend/img/catalogImg--white.jpg'))">

<meta name="twitter:image" content="@yield('image', asset('frontend/img/catalogImg--white.jpg'))">
<meta name="twitter:card" content="summary">
<meta name="twitter:url" content="{{ request()->fullUrl() }}">

<meta name="twitter:title" content="@yield('title', 'STALEKS')">
<meta name="twitter:description" content="@yield('description', 'STALEKS')">
