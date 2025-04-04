@extends('layouts.app')

@section('content')
    @include('includes.flash-mesages')

    <h3 class="container mt-4 mb-4">Audio Files</h3>

    <!-- Upload Button -->
    <div class="container mt-4 mb-3">
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#uploadMediaModal">
           Upload  <i class="bi bi-headphones"></i>
        </button>
    </div>

    <!-- Search Bar -->
    <div class="container mt-3 mb-3">
        <form action="{{ route('media.index') }}" method="GET">
            <div class="input-group">
                <input type="text" id="searchInput" name="search" class="form-control form-control-sm" placeholder="Search by title">
            </div>
        </form>
    </div>

    @include('media.create')

    <!-- Audio File Grid -->
    <div class="container">
        <div class="row">
            @foreach ($item as $media)
                @if ($media->type === 'audio')
                    <div class="col-6 col-md-4 col-lg-3 mb-3 media-item">
                        <div class="card h-100 small-card">
                            <div class="card-body text-center p-2">
                                <!-- Title (Wraps if too long) -->
                                <h6 class="card-title media-title mt-2 text-truncate" title="{{ $media->title }}">
                                    <i class="bi bi-headphones"></i>
                                    {{ Str::limit($media->title, 25) }}
                                </h6>

                                <!-- Action Buttons -->
                                <div class="d-flex justify-content-center mt-2">
                                    <!-- View Button -->
                                    <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="#viewMediaModal-{{ $media->id }}">
                                        <i class="bi bi-eye"></i>
                                    </button>

                                    <!-- Delete Button -->
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

    <div class="container text-center mt-3">
        <button id="backButton" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Back
        </button>
    </div>

    @include('includes.back-button')
    <!-- JavaScript for Real-time Search -->
    @include('includes.searchMedia')

    <style>
        .small-card {
            height: 170px; /* Make card smaller */
            max-width: 220px;
        }

        .small-card .card-title {
            font-size: 0.9rem; /* Reduce title font size */
            white-space: normal; /* Allow wrapping */
            word-break: break-word; /* Wrap long words */
            overflow-wrap: break-word;
            line-height: 1.2;
        }

        .small-audio {
            height: 25px; /* Reduce audio player size */
        }

        .btn-sm {
            padding: 4px 6px; /* Make buttons smaller */
            font-size: 0.8rem;
        }

        .search-bar {
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
@endsection
