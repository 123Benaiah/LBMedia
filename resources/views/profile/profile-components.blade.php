<script>
    // Activate Bootstrap tabs
    document.addEventListener('DOMContentLoaded', function() {
        const tabElms = document.querySelectorAll('button[data-bs-toggle="tab"]');
        tabElms.forEach(tabElm => {
            tabElm.addEventListener('click', function(event) {
                event.preventDefault();
                const tab = new bootstrap.Tab(this);
                tab.show();
            });
        });

        // Profile photo preview
        const profilePhotoInput = document.getElementById('profile-photo-input');
        if (profilePhotoInput) {
            profilePhotoInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('profile-photo-preview').src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });
        }
    });

    function confirmPhotoDelete() {
        const modal = new bootstrap.Modal(document.getElementById('deletePhotoModal'));
        modal.show();
    }
</script>
<style>
    .nav-tabs-bordered {
        border-bottom: 2px solid #dee2e6;
    }

    .nav-tabs-bordered .nav-link {
        margin-bottom: -2px;
        border: none;
        color: #495057;
    }

    .nav-tabs-bordered .nav-link.active {
        background-color: #fff;
        color: #4154f1;
        border-bottom: 2px solid #4154f1;
    }

    .nav-tabs-bordered .nav-link:hover:not(.active) {
        border-bottom: 2px solid #dee2e6;
        margin-bottom: -2px;
    }

    .card {
        border: none;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    .card-body {
        padding: 2rem;
    }

    .card-title {
        font-size: 1.3rem;
        margin-bottom: 1.5rem;
        color: #012970;
        font-weight: 600;
    }

    #profile-photo-preview {
        width: 150px;
        height: 150px;
        object-fit: cover;
    }
</style>
