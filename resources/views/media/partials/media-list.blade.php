<div class="row">
    @foreach ($media as $item)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <!-- Media Preview -->
                    @if ($item->type === 'image')
                        <img src="{{ asset('storage/' . $item->file_path) }}" class="img-fluid" alt="{{ $item->title }}">
                    @elseif($item->type === 'video')
                        <video width="100%" controls>
                            <source src="{{ asset('storage/' . $item->file_path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @elseif($item->type === 'audio')
                        <audio controls style="width: 100%;">
                            <source src="{{ asset('storage/' . $item->file_path) }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    @endif

                    <!-- Media Details -->
                    <h6 class="card-title mt-2">{{ $item->title }}</h6>
                    <p class="card-text">{{ $item->type }}</p>

                    <!-- Delete Button -->
                    <form action="{{ route('media.destroy', $item->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this file?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash3-fill"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>


