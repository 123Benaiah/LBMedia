@extends('layouts.app')

@section('content')
    @include('includes.flash-mesages')
    <div class="main">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-edit">Profile</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#profile-change-password">Password</button>
                                </li>
                            </ul>

                            <div class="tab-content pt-2">
                                <!-- Profile Edit Tab -->
                                <div class="tab-pane fade show active" id="profile-edit">
                                    <h5 class="card-title">Edit Profile</h5>

                                    <form method="POST" action="{{ route('profile.update') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="row mb-3">
                                            <div class="col-md-4 text-center">
                                                <img src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('assets/img/profile-img.jpg') }}"
                                                    alt="Profile" class="rounded-circle" width="150"
                                                    id="profile-photo-preview">
                                                <div class="mt-3">
                                                    <input type="file" name="profile_photo" id="profile-photo-input"
                                                        style="display: none;" accept="image/*">
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        onclick="document.getElementById('profile-photo-input').click()">
                                                        <i class="bi bi-upload"></i>
                                                    </button>
                                                    @if (Auth::user()->profile_photo)
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="confirmPhotoDelete()">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="row mb-3">
                                                    <label for="name" class="col-md-3 col-form-label">Full Name</label>
                                                    <div class="col-md-9">
                                                        <input name="name" type="text"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            id="name" value="{{ old('name', Auth::user()->name) }}"
                                                            required>
                                                        @error('name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="email" class="col-md-3 col-form-label">Email</label>
                                                    <div class="col-md-9">
                                                        <input name="email" type="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            id="email" value="{{ old('email', Auth::user()->email) }}"
                                                            required>
                                                        @error('email')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-center mt-7">
                                            <button type="submit" class="btn btn-primary">Update Profile</button>
                                        </div>
                                    </form>
                                </div><!-- End Profile Edit Tab -->

                                <!-- Change Password Tab -->
                                <div class="tab-pane fade" id="profile-change-password">
                                    <h5 class="card-title">Change Password</h5>

                                    <form method="POST" action="{{ route('profile.password') }}">
                                        @csrf
                                        @method('PUT')

                                        <div class="row mb-3">
                                            <label for="current_password" class="col-md-4 col-form-label">Current
                                                Password</label>
                                            <div class="col-md-8 position-relative">
                                                <input name="current_password" type="password"
                                                    class="form-control @error('current_password') is-invalid @enderror"
                                                    id="current_password" required>
                                                <i class="bi bi-eye-slash toggle-password" toggle="#current_password"></i>
                                                @error('current_password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="password" class="col-md-4 col-form-label">New Password</label>
                                            <div class="col-md-8 position-relative">
                                                <input name="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="password" required>
                                                <i class="bi bi-eye-slash toggle-password" toggle="#password"></i>
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="password_confirmation" class="col-md-4 col-form-label">Confirm
                                                Password</label>
                                            <div class="col-md-8 position-relative">
                                                <input name="password_confirmation" type="password" class="form-control"
                                                    id="password_confirmation" required>
                                                <i class="bi bi-eye-slash toggle-password"
                                                    toggle="#password_confirmation"></i>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Change Password</button>
                                        </div>
                                    </form>
                                </div><!-- End Change Password Tab -->
                            </div><!-- End Bordered Tabs -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Photo Confirmation Modal -->
    <div class="modal fade" id="deletePhotoModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Photo Removal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to remove your profile photo?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form method="POST" action="{{ route('profile.photo.delete') }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Remove Photo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('profile.profile-components')

    <!-- Password Toggle Styles -->
    <style>
        .toggle-password {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            z-index: 2;
            color: #6c757d;
        }
    </style>

    <!-- Password Toggle Script -->
    <script>
        document.querySelectorAll('.toggle-password').forEach(function (icon) {
            icon.addEventListener('click', function () {
                const targetInput = document.querySelector(this.getAttribute('toggle'));
                const type = targetInput.getAttribute('type') === 'password' ? 'text' : 'password';
                targetInput.setAttribute('type', type);
                this.classList.toggle('bi-eye');
                this.classList.toggle('bi-eye-slash');
            });
        });
    </script>
@endsection
