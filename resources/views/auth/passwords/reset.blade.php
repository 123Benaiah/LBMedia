<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Reset Password</title>

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
      z-index: -2;
    }

    .overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      z-index: -1;
    }

    .h-custom {
      height: 100vh;
    }

    .card-container {
      max-width: 400px;
      width: 100%;
      background: rgba(255, 255, 255, 0.95);
      border-radius: 10px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      transition: all 0.3s ease;
    }

    .card-container:hover {
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
    }

    .form-control {
      padding: 12px 15px;
      border: none;
      border-bottom: 2px solid #3b71ca !important;
      background-color: transparent;
      border-radius: 0;
      margin-bottom: 1.5rem;
      transition: all 0.3s ease;
      box-shadow: none;
    }

    .form-control::placeholder {
      color: #5a6268;
      opacity: 1 !important;
      font-weight: 400;
    }

    .form-control:focus {
      border-bottom: 2px solid #2c5aa8;
    }

    .btn-auth {
      padding: 12px;
      border-radius: 8px;
      font-weight: 600;
      letter-spacing: 0.5px;
      transition: all 0.3s ease;
    }

    .btn-auth:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(96, 199, 83, 0.863);
    }
    .toggle-password {
      position: absolute;
      top: 50%;
      right: 15px;
      transform: translateY(-50%);
      cursor: pointer;
      color: #6c757d;
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

  <section class="vh-100">
    <div class="container h-100">
      <div class="row d-flex align-items-center justify-content-center h-100">
        <!-- Form Card -->
        <div class="col-md-8 col-lg-6 col-xl-5">
          <div class="card card-container shadow p-4">
            <h3 class="fw-normal mb-3 pb-3 text-center">Reset Password</h3>
            <form method="POST" action="{{ route('password.update') }}">
              @csrf
              <input type="hidden" name="token" value="{{ $token }}">

              <div class="form-outline mb-4">
                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus />
                <label class="form-label" for="email">Email Address</label>
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-outline mb-4">
                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" />
                <label class="form-label" for="password">New Password</label>
                <i class="fa fa-eye toggle-password" data-target="password"></i>
                @error('password')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-outline mb-4">
                <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autocomplete="new-password" />
                <label class="form-label" for="password-confirm">Confirm Password</label>
                <i class="fa fa-eye toggle-password" data-target="password-confirm"></i>
              </div>

              <div class="text-center">
                <button type="submit" class="btn btn-primary btn-auth btn-block">Reset Password</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
    <!-- Toggle Password Script -->
    <script>
        document.querySelectorAll('.toggle-password').forEach(icon => {
          icon.addEventListener('click', () => {
            const input = document.getElementById(icon.getAttribute('data-target'));
            const isPassword = input.getAttribute('type') === 'password';
            input.setAttribute('type', isPassword ? 'text' : 'password');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
          });
        });
      </script>

</body>

</html>
