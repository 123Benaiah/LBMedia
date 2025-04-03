<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlushMedia</title>

    @include('components.css') <!-- Include CSS files -->
</head>

<body>
    @include('includes.header') <!-- Header Section -->

    @include('includes.sidebar') <!-- Sidebar -->

    <main id="main" class="main">
        @yield('content') <!-- Main Content -->
    </main>

    @include('includes.footer') <!-- Footer -->

    <!-- Authentication Links -->
    <div class="auth-links">
        @auth
            <!-- If user is logged in, show logout button -->
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        @else
            <!-- If user is logged out, show login link -->
            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
        @endauth
    </div>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Preloader -->
    <div id="preloader"></div>
    @include('components.js') <!-- JavaScript Files -->
</body>

</html>
