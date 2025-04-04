<div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content auth-card">
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center text-decoration-none">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="" class="me-2" style="height: 40px;">
                        <span class="d-none d-lg-block text-dark fw-bold fs-4">BlushMedia</span>
                    </a>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>

                <h3 class="text-center mb-4" style="color: #3b71ca;">Login</h3>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-outline mb-4">
                        <input type="email" id="loginEmail" name="email" class="form-control"
                            placeholder="Email address" required />
                    </div>

                    <div class="form-outline mb-4 position-relative">
                        <input type="password" id="loginPassword" name="password" class="form-control"
                            placeholder="Password" required />
                        <i class="fa fa-eye toggle-password text-secondary"
                            data-target="loginPassword"></i>
                    </div>

                    <div class="d-flex justify-content-between mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                        <a href="{{ route('password.request') }}" class="link-dark">Forgot password?</a>
                    </div>

                    <div class="text-center mb-3">
                        <button class="btn btn-login btn-auth btn-block text-white" type="submit">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </button>
                    </div>
                </form>

                <p class="text-center mt-3">Don't have an account?
                    <a href="#" class="link-primary" data-mdb-dismiss="modal" data-mdb-toggle="modal" data-mdb-target="#registerModal">
                        Register here
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
