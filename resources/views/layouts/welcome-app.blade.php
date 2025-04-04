<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlushMedia</title>

    @include('components.css') <!-- Include CSS files -->
</head>

<body>
    @include('includes.welcome-header') <!-- Header Section -->

    <main id="main" class="main">
        @yield('content') <!-- Main Content -->
    </main>

    @include('includes.welcome-footer') <!-- Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Preloader -->
    <div id="preloader"></div>
    @include('components.js') <!-- JavaScript Files -->
</body>

</html>
