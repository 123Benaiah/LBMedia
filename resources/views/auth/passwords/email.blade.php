<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        /* Video Background Styles */
        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1; /* Places video behind content */
            object-fit: cover; /* Ensures video covers entire screen */
        }

        /* Overlay to improve readability (optional) */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Semi-transparent black */
            z-index: -1;
        }

        /* Adjust card styles for better visibility */
        .card-container {
            max-width: 400px;
            width: 100%;
            background: rgba(255, 255, 255, 0.9); /* Slightly transparent white */
            border-radius: 10px;
        }

        .h-custom {
            height: 100vh;
        }
        .custom-link {
        color: blue;
        text-decoration: underline;
    }

    .custom-link:hover {
        color: black;
    }
    </style>
</head>
<body>

<!-- Background Video -->
<video class="video-background" autoplay loop muted>
    <source src="{{ asset('storage/media/videos/background1.mp4') }}" type="video/mp4">
</video>

<!-- Optional Overlay (darkens the video) -->
<div class="overlay"></div>

<section class="vh-100 d-flex align-items-center justify-content-center">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card card-container shadow p-4">
                    <h3 class="fw-normal mb-3 pb-3 text-center">Reset Password</h3>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-outline mb-4">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <label class="form-label" for="email">Email Address</label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Send Password Reset Link</button>
                        </div>
                    </form>
                    <div class="mt-3 mb-2">
                        <a href="{{ route('login') }}" class="custom-link">Back to Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>
