@extends('layouts.app')

@section('content')
@include('includes.flash-mesages')

<!-- Back Button -->
<a href="{{ route('media.index') }}" class="btn btn-secondary mb-3">← Back to Folders</a>

<!-- Folder Title -->
<h4 class="mb-4">{{ ucfirst($type) }} Folder</h4>

<!-- Upload Media Button -->
<button type="button" class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#uploadMediaModal">
    <i class="bi bi-upload me-2"></i> Upload {{ ucfirst($type) }}
</button>

<!-- Include the Modal -->
@include('media.create')

<!-- Display Media Based on Type -->
<div class="row">
    @foreach ($media as $item)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm p-3">
                <h6 class="text-center">{{ $item->title }}</h6>

                <!-- Media Preview -->
                <div class="text-center">
                    @if ($type === 'image')
                        <img src="{{ asset('storage/' . $item->file_path) }}" class="img-fluid rounded">
                    @elseif ($type === 'video')
                        <video width="100%" controls>
                            <source src="{{ asset('storage/' . $item->file_path) }}" type="video/mp4">
                        </video>
                    @elseif ($type === 'audio')
                        <audio controls>
                            <source src="{{ asset('storage/' . $item->file_path) }}" type="audio/mpeg">
                        </audio>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-between mt-3">
                    <!-- View Button -->
                    <button type="button" class="btn btn-info btn-sm me-2" data-bs-toggle="modal"
                        data-bs-target="#viewMediaModal-{{ $item->id }}">
                        <i class="bi bi-eye"></i> View
                    </button>

                    <!-- Delete Button -->
                    <form action="{{ route('media.destroy', $item->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this file?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash3-fill"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        @include('media.view')
    @endforeach
</div>

@endsection
