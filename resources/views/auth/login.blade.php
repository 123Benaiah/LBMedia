<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        /* Video Background */
        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        /* Overlay for better readability */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }

        /* Main container */
        .auth-container {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Card styling */
        .auth-card {
            max-width: 400px;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .auth-card:hover {
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        /* Form elements with blue bottom borders */
        .form-control {
            padding: 12px 15px;
            border: none;
            /* Remove all borders */
            border-bottom: 2px solid #3b71ca !important;
            /* Only keep bottom border */
            background-color: transparent;
            border-radius: 0;
            /* Round corners to 0 (optional) */
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
            box-shadow: none;
            /* No shadow */
        }

        .form-control::placeholder {
            color: #5a6268;
            /* Darker gray for better contrast */
            opacity: 1 !important;
            /* Force full visibility */
            font-weight: 400;
            /* Optional: makes text more readable */
        }

        .form-control:focus {
            border-bottom: 2px solid #2c5aa8;
            /* Change bottom border color on focus (optional) */
        }

        .form-control:focus::placeholder {
            color: #6c757d;
            /* Lighter gray when focused */
        }

        .btn-auth {
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-login {
            background-color: #3b71ca;
        }

        .btn-login:hover {
            background-color: #10336e;
            /* Darker blue color on hover */
        }

        .btn-register {
            background-color: #3a5175;;
        }
        .btn-register:hover {
            background-color: #4483e8;;
        }

        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(96, 199, 83, 0.863);
        }

        /* Form header */
        .auth-header {
            color: #333;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        /* Animation for form switching */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-animate {
            animation: fadeIn 0.3s ease-out;
        }
    </style>
</head>

<body>

    <!-- Background Video -->
    <video class="video-background" autoplay loop muted playsinline>
        <source src="{{ asset('storage/media/videos/background1.mp4') }}" type="video/mp4">
        Your browser does not support HTML5 video.
    </video>

    <!-- Dark Overlay -->
    <div class="overlay"></div>

    <section class="auth-container">
        @include('includes.flash-mesages')
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card auth-card shadow p-4">
                        <!-- Login Form -->
                        <div id="login-form" class="form-animate">
                            <h3 class="auth-header text-center">Login</h3>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-outline mb-4">
                                    <input type="email" id="loginEmail" name="email" class="form-control"
                                        placeholder="Email address" required />
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" id="loginPassword" name="password" class="form-control"
                                        placeholder="Password" required />
                                </div>

                                <div class="text-center mb-3">
                                    <button class="btn btn-login btn-auth btn-block text-white" type="submit">
                                        <i class="fas fa-sign-in-alt me-2"></i>Login
                                    </button>
                                </div>
                            </form>

                            <p class="text-center mt-3"><a href="{{ route('password.request') }}"
                                    class="link-dark">Forgot password?</a></p>
                            <p class="text-center">Don't have an account? <a href="#" class="link-primary"
                                    onclick="toggleForm()">Register here</a></p>

                        </div>

                        <!-- Register Form -->
                        <div id="register-form" style="display: none;" class="form-animate">
                            <h3 class="auth-header text-center">Create Account</h3>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-outline mb-4">
                                    <input type="text" id="registerName" name="name" class="form-control"
                                        placeholder="Full Name" required />
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="email" id="registerEmail" name="email" class="form-control"
                                        placeholder="Email address" required />
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" id="registerPassword" name="password" class="form-control"
                                        placeholder="Password" required />
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" id="confirmPassword" name="password_confirmation"
                                        class="form-control" placeholder="Confirm Password" required />
                                </div>

                                @if ($errors->any())
                                <div class="alert alert-danger mb-4">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                                <div class="text-center mb-3">
                                    <button class="btn btn-register btn-auth btn-block text-white" type="submit">
                                        <i class="fas fa-user-plus me-2"></i>Register
                                    </button>
                                </div>
                            </form>

                            <div class="text-center">
                                <a href="#" class="auth-link" onclick="toggleForm()">Already have an account?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function toggleForm() {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');

            if (loginForm.style.display === "none") {
                loginForm.style.display = "block";
                registerForm.style.display = "none";
            } else {
                loginForm.style.display = "none";
                registerForm.style.display = "block";
            }

            // Re-trigger animation
            loginForm.classList.remove('form-animate');
            registerForm.classList.remove('form-animate');
            void loginForm.offsetWidth; // Trigger reflow
            void registerForm.offsetWidth; // Trigger reflow
            loginForm.classList.add('form-animate');
            registerForm.classList.add('form-animate');
        }
    </script>

</body>

</html>
