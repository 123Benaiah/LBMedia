<!-- Include Animate.css for animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<style>
    .alert {
        max-width: 600px;
        margin: 0 auto;
        text-align: center;
        padding: 17px;
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 9999;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: auto;
        display: none;
    }


    .shake-icon {
        display: inline-block;
        animation: shake 1s infinite alternate;
    }

    @keyframes shake {
        0% {
            transform: translateX(0);
        }

        25% {
            transform: translateX(-2px);
        }

        50% {
            transform: translateX(2px);
        }

        75% {
            transform: translateX(-2px);
        }

        100% {
            transform: translateX(2px);
        }
    }

    .flash-icon {
        animation: flash 1.5s infinite alternate;
    }

    @keyframes flash {
        0% {
            opacity: 1;
        }

        100% {
            opacity: 0.3;
        }
    }
</style>

<div id="alert-container" class="position-fixed top-0 start-50 translate-middle-x p-3"
    style="z-index: 9999; max-width: 1200px; width: 100%; padding: 20px;">
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show animate__animated animate__fadeInDown" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li><strong>{{ $error }}</strong></li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeInDown" role="alert">
            <i class="fas fa-check-circle shake-icon"></i>
            <strong>{{ session('success') }}</strong>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show animate__animated animate__fadeInDown"
            role="alert">
            <i class="fas fa-exclamation-circle shake-icon"></i>
            <strong>{{ session('error') }}</strong>
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning alert-dismissible fade show animate__animated animate__fadeInDown"
            role="alert">
            <i class="fas fa-exclamation-triangle flash-icon"></i>
            <strong>{{ session('warning') }}</strong>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            alert.style.display = 'block';
        });

        // Auto dismiss after 6 seconds
        setTimeout(function() {
            alerts.forEach(function(alert) {
                alert.classList.add('animate__fadeOutUp');
                setTimeout(() => alert.remove(), 1000);
            });
        }, 6000);
    });
</script>
