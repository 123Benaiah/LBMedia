<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link active animated-link" href="#">
          <i class="bi bi-house-door-fill"></i>
          <span>Welcome</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link active animated-link" href="{{ route('login') }}">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link active animated-link" href="{{ route('register') }}">
          <i class="bi bi-person-plus-fill"></i>
          <span>Register</span>
        </a>
      </li>

    </ul>
  </aside><!-- End Sidebar -->

<style>
    .animated-link i {
      transition: transform 0.3s ease;
    }

    .animated-link:hover i {
      transform: scale(1.2) rotate(10deg);
      color: #0d6efd; /* Bootstrap primary */
    }

    .animated-link span {
      transition: color 0.3s;
    }

    .animated-link:hover span {
      color: #0d6efd;
    }
  </style>

