<style>
     .form-outline .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
</style>
<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content auth-card p-4">
        <div class="modal-header border-0">
          <h5 class="modal-title auth-header" id="registerModalLabel">Create Account</h5>
          <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body form-animate">
          <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-outline mb-4">
              <input type="text" id="modalRegisterName" name="name" class="form-control" placeholder="Full Name" required />
            </div>
            <div class="form-outline mb-4">
              <input type="email" id="modalRegisterEmail" name="email" class="form-control" placeholder="Email address" required />
            </div>
            <div class="form-outline mb-4 position-relative">
              <input type="password" id="modalRegisterPassword" name="password" class="form-control" placeholder="Password" required />
              <i class="fa fa-eye toggle-password text-secondary" data-target="modalRegisterPassword"></i>
            </div>
            <div class="form-outline mb-4 position-relative">
              <input type="password" id="modalConfirmPassword" name="password_confirmation" class="form-control" placeholder="Confirm Password" required />
              <i class="fa fa-eye toggle-password text-secondary" data-target="modalConfirmPassword"></i>
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
              <button class="btn btn-register btn-auth text-white w-100" type="submit">
                <i class="fas fa-user-plus me-2"></i>Register
              </button>
            </div>
          </form>
          <div class="text-center">
            <a href="#" class="auth-link" data-mdb-dismiss="modal" data-mdb-toggle="modal" data-mdb-target="#loginModal">Already have an account?</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    document.querySelectorAll('.toggle-password').forEach(icon => {
      icon.addEventListener('click', () => {
        const target = document.getElementById(icon.getAttribute('data-target'));
        const isPassword = target.getAttribute('type') === 'password';
        target.setAttribute('type', isPassword ? 'text' : 'password');
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
      });
    });
  </script>
