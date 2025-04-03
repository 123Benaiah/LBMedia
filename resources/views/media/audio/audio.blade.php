@extends('layouts.app')

@section('content')
    @include('includes.flash-mesages')
    <h3 class="text-center mt-4">Audio Files</h3>

     <!-- Button to trigger modal -->
     <div class="mt-4 mb-4">
        <!-- Upload Video Button -->
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#uploadMediaModal">
            <i class="bi bi-upload me-2"></i> Upload
            <i class="bi bi-camera-reels mx-1"></i>
        </button>
    </div>
    <!-- Search Bar at the Bottom -->
    <div class="search-bar mt-3 mb-4">
        <form action="{{ route('media.index') }}" method="GET" class="d-flex">
            <div class="input-group">
                <input type="text" name="search" class="form-control rounded-start" placeholder="Search by title"
                    aria-label="Search">
                <button type="submit" class="btn btn-outline-secondary rounded-end">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
    </div>

    <!-- upload the Modal -->
    @include('media.create')

    @foreach ($item as $item)
        @if ($item->type === 'audio')
            <div class="d-flex align-items-center gap-4 mb-3 border p-3 rounded">
                <i class="bi bi-music-note-beamed audio-icon"></i>{{ $item->title }}

                <!-- Media Preview for Audio
                <div class="media-preview">
                    <audio controls>
                        <source src="{{ asset('storage/' . $item->file_path) }}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                </div>
            -->

                <!-- Media Details -->
                <div class="d-flex align-items-center ms-auto">
                    <!-- View Button -->
                    <button type="button" class="btn btn-info btn-sm me-2" data-bs-toggle="modal" data-bs-target="#viewMediaModal-{{ $item->id }}">
                        <i class="bi bi-eye"></i> View
                    </button>

                    <!-- Delete Button -->
                    <form action="{{ route('media.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this file?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash3-fill"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- View Media Modal -->
            @include('media.view', ['item' => $item])
        @endif
    @endforeach
    <button id="backButton" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
    </button>
    @include('includes.back-button')
@endsection
