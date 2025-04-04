<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlushMedia - Cloud Storage</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
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

        /* Modal Styles */
        .auth-modal .modal-dialog {
            max-width: 400px;
        }

        .auth-modal .modal-content {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            border: none;
        }

        .auth-modal .modal-header {
            border-bottom: none;
            padding-bottom: 0;
            position: relative;
        }

        .auth-modal .btn-close {
            position: absolute;
            right: 20px;
            top: 20px;
        }

        .auth-modal .form-control {
            padding: 12px 15px;
            border: none;
            border-bottom: 2px solid #3b71ca !important;
            background-color: transparent;
            border-radius: 0;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
            box-shadow: none;
        }

        .auth-modal .form-control::placeholder {
            color: #5a6268;
            opacity: 1 !important;
            font-weight: 400;
        }

        .auth-modal .form-control:focus {
            border-bottom: 2px solid #2c5aa8;
        }

        .auth-modal .btn-auth {
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            width: 100%;
        }

        .auth-modal .btn-login {
            background-color: #3b71ca;
        }

        .auth-modal .btn-login:hover {
            background-color: #2c5aa8;
        }

        .auth-modal .btn-register {
            background-color: #14a44d;
        }

        .auth-modal .btn-register:hover {
            background-color: #0d803a;
        }

        .auth-modal .form-outline .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #5a6268;
        }

        .auth-modal .modal-footer {
            border-top: none;
            justify-content: center;
            padding-top: 0;
        }

        .auth-modal .modal-footer a {
            color: #3b71ca;
            font-weight: 500;
        }

        .auth-modal .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .auth-modal .logo img {
            height: 40px;
            margin-right: 10px;
        }

        .auth-modal .logo span {
            font-weight: 700;
            font-size: 1.5rem;
            color: #3b71ca;
        }
    </style>
</head>

<body>
    <!-- Background Video -->
    <video class="video-background" autoplay loop muted playsinline>
        <source src="{{ asset('storage/media/videos/background1.mp4') }}" type="video/mp4">
    </video>

    <!-- Login Modal -->
    <div class="modal fade auth-modal" id="loginModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="logo">
                        <img src="{{ asset('storage/media/images/logo.png') }}" alt="BlushMedia">
                        <span>BlushMedia</span>
                    </div>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h3 class="text-center mb-4" style="color: #3b71ca;">Welcome Back</h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-outline mb-4">
                            <input type="email" id="loginEmail" name="email" class="form-control" placeholder="Email address" required />
                        </div>

                        <div class="form-outline mb-4 position-relative">
                            <input type="password" id="loginPassword" name="password" class="form-control" placeholder="Password" required />
                            <i class="fa fa-eye toggle-password" data-target="loginPassword"></i>
                        </div>

                        <div class="d-flex justify-content-between mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember" />
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                            <a href="{{ route('password.request') }}">Forgot password?</a>
                        </div>

                        <button class="btn btn-login btn-auth text-white mb-4" type="submit">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </button>
                    </form>
                </div>
                <div class="modal-footer">
                    <p class="text-center">Don't have an account? <a href="#" data-mdb-dismiss="modal" data-mdb-toggle="modal" data-mdb-target="#registerModal">Sign up</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div class="modal fade auth-modal" id="registerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="logo">
                        <img src="{{ asset('storage/media/images/logo.png') }}" alt="BlushMedia">
                        <span>BlushMedia</span>
                    </div>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h3 class="text-center mb-4" style="color: #14a44d;">Create Account</h3>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-outline mb-4">
                            <input type="text" id="registerName" name="name" class="form-control" placeholder="Full Name" required />
                        </div>

                        <div class="form-outline mb-4">
                            <input type="email" id="registerEmail" name="email" class="form-control" placeholder="Email address" required />
                        </div>

                        <div class="form-outline mb-4 position-relative">
                            <input type="password" id="registerPassword" name="password" class="form-control" placeholder="Password" required />
                            <i class="fa fa-eye toggle-password" data-target="registerPassword"></i>
                        </div>

                        <div class="form-outline mb-4 position-relative">
                            <input type="password" id="confirmPassword" name="password_confirmation" class="form-control" placeholder="Confirm Password" required />
                            <i class="fa fa-eye toggle-password" data-target="confirmPassword"></i>
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

                        <button class="btn btn-register btn-auth text-white mb-4" type="submit">
                            <i class="fas fa-user-plus me-2"></i>Register
                        </button>
                    </form>
                </div>
                <div class="modal-footer">
                    <p class="text-center">Already have an account? <a href="#" data-mdb-dismiss="modal" data-mdb-toggle="modal" data-mdb-target="#loginModal">Sign in</a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize MDB modals
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            document.querySelectorAll('.toggle-password').forEach(icon => {
                icon.addEventListener('click', () => {
                    const targetInput = document.getElementById(icon.getAttribute('data-target'));
                    const isPassword = targetInput.getAttribute('type') === 'password';
                    targetInput.setAttribute('type', isPassword ? 'text' : 'password');
                    icon.classList.toggle('fa-eye');
                    icon.classList.toggle('fa-eye-slash');
                });
            });

            // Show login modal by default (remove this if you want to trigger it manually)
            const loginModal = new mdb.Modal(document.getElementById('loginModal'));
            loginModal.show();
        });

        // Function to switch between modals
        function switchModal(from, to) {
            const fromModal = new mdb.Modal(document.getElementById(from));
            const toModal = new mdb.Modal(document.getElementById(to));
            fromModal.hide();
            toModal.show();
        }
    </script>
</body>
</html>
