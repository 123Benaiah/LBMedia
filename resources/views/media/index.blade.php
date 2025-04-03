@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center mt-4">
        <h3>Media Folders</h3>
    </div>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <!-- Audio Folder Card -->
            <div class="col-md-4">
                <a href="{{ route('media_audio') }}" class="text-decoration-none">
                    <div class="card text-center shadow-sm hover-effect">
                        <div class="card-body">
                            <i class="fas fa-folder fa-4x text-primary"></i>
                            <h5 class="mt-3">Audio</h5>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Video Folder Card -->
            <div class="col-md-4">
                <a href="{{ route('media_video') }}" class="text-decoration-none">
                    <div class="card text-center shadow-sm hover-effect">
                        <div class="card-body">
                            <i class="fas fa-folder fa-4x text-danger"></i>
                            <h5 class="mt-3">Video</h5>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Image Folder Card -->
            <div class="col-md-4">
                <a href="{{ route('media_image') }}" class="text-decoration-none">
                    <div class="card text-center shadow-sm hover-effect">
                        <div class="card-body">
                            <i class="fas fa-folder fa-4x text-success"></i>
                            <h5 class="mt-3">Image</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <style>
        .hover-effect:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease-in-out;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
@endsection
