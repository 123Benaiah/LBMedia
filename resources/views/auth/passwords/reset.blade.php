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
        .h-custom {
            height: 100vh;
        }
        .card-container {
            max-width: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
    <section class="vh-100">
        <div class="container h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <!-- Left side (Form Card) -->
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
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-outline mb-4">
                            <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autocomplete="new-password" />
                            <label class="form-label" for="password-confirm">Confirm Password</label>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>
