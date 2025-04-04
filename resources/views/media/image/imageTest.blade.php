@extends('layouts.app')

@section('content')
    @include('includes.flash-mesages')

    <!-- Upload Button -->
    <div class="container mt-4 mb-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadMediaModal">
            <i class="bi bi-upload me-2"></i> Upload Media
        </button>
    </div>

    <!-- Search Bar -->
    <div class="container mt-3 mb-7">
        <form action="{{ route('media.index') }}" method="GET">
            <div class="input-group">
                <input type="text" id="searchInput" name="search" class="form-control" placeholder="Search by title">
                <button type="submit" class="btn btn-outline-secondary">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
    </div>

    @include('media.create')

    <div class="container">
        <h3 class="text-center mt-4 mb-4">All Image Files</h3>

        <div class="row" id="mediaContainer">
            @foreach ($images as $media)
                @if ($media->type === 'image')
                    <div class="col-md-6 col-lg-4 mb-4 media-item">
                        <div class="card h-100">
                            <div class="card-body d-flex align-items-center">
                                <i class="bi bi-image fs-3 me-3"></i>
                                <div class="flex-grow-1">
                                    <h5 class="card-title">{{ $media->title }}</h5>
                                </div>
                                <div class="d-flex">
                                    <button class="btn btn-info btn-sm me-2" data-bs-toggle="modal" data-bs-target="#viewMediaModal-{{ $media->id }}">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <form action="{{ route('media.destroy', $media->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('media.view', ['item' => $media])
                @endif
            @endforeach
        </div>
    </div>

    <div class="container text-center mt-4">
        <button id="backButton" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </button>
    </div>

    @include('includes.back-button')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let searchInput = document.getElementById("searchInput");
            let mediaItems = document.querySelectorAll(".media-item");

            searchInput.addEventListener("keyup", function() {
                let searchText = searchInput.value.toLowerCase();

                mediaItems.forEach(function(item) {
                    let title = item.querySelector(".card-title").innerText.toLowerCase();

                    if (title.includes(searchText)) {
                        item.style.display = "block";
                    } else {
                        item.style.display = "none";
                    }
                });
            });
        });
    </script>

    <style>
        .search-bar {
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
@endsection
