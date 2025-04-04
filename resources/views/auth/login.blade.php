<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlushMedia</title>
    @include('components.css')
    <style>
        /* Video Background Styles */
        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
            opacity: 0.15;
        }

        .overlay {
            position: relative;
            z-index: 1;
            background-color: rgba(255, 255, 255, 0.351);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 10px;
            transition: transform 0.3s ease;
            height: 100%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: #6c63ff;
            margin-bottom: 1rem;
        }
    </style>
</head>


<body>
    <!-- Background Video -->
    <video class="video-background" autoplay loop muted>
        <source src="{{ asset('storage/media/videos/background1.mp4') }}" type="video/mp4">
    </video>

    @include('includes.welcome-header')

    @include('includes.welcome-sidebar') <!-- Sidebar -->

    <main id="main" class="main py-10">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <div class="overlay text-center mb-5">
                        <h1 class="display-4 fw-bold mb-3">Welcome to BlushMedia! 🌟</h1>
                        <p class="lead">Your ultimate cloud storage solution for videos, audio, and images.</p>
                    </div>

                    <div class="row g-4">
                        <!-- Feature Card 1 -->
                        <div class="col-md-4">
                            <div class="feature-card p-4 text-center">
                                <div class="feature-icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <h3>Secure Cloud Storage</h3>
                                <p>Store all your media files safely with military-grade encryption and automatic
                                    backups.</p>
                            </div>
                        </div>

                        <!-- Feature Card 2 -->
                        <div class="col-md-4">
                            <div class="feature-card p-4 text-center">
                                <div class="feature-icon">
                                    <i class="fas fa-play-circle"></i>
                                </div>
                                <h3>Instant Streaming</h3>
                                <p>Watch videos and listen to audio directly from your cloud without downloading.</p>
                            </div>
                        </div>

                        <!-- Feature Card 3 -->
                        <div class="col-md-4">
                            <div class="feature-card p-4 text-center">
                                <div class="feature-icon">
                                    <i class="fas fa-download"></i>
                                </div>
                                <h3>Lightning Fast Downloads</h3>
                                <p>Get your files anytime with our high-speed download servers worldwide.</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center flex-wrap gap-3 mt-5">
                        <a href="{{ route('register') }}" class="btn btn-primary px-4 py-3">
                            Get Started - It's Free
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-primary px-4 py-3">
                            Login
                        </a>
                    </div>


                </div>
            </div>
        </div>
    </main>

    @include('includes.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Preloader -->
    <div id="preloader"></div>
    @include('components.js')
</body>

</html>
