<!-- View Media Modal -->
<div class="modal fade" id="viewMediaModal-{{ $item->id }}" tabindex="-1" aria-labelledby="viewMediaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewMediaModalLabel">{{ $item->title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($item->type === 'image')
                    <img src="{{ asset($item->file_path) }}" class="img-fluid" alt="{{ $item->title }}">
                @elseif($item->type === 'video')
                    <video id="video-{{ $item->id }}" width="100%" controls>
                        <source src="{{ asset($item->file_path) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @elseif($item->type === 'audio')
                    <audio id="audio-{{ $item->id }}" controls style="width: 100%;">
                        <source src="{{ asset($item->file_path) }}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-view').forEach(button => {
            button.addEventListener('click', function() {
                let mediaId = this.getAttribute('data-id');
                fetch(`/media/increment-views/${mediaId}`, {
                        method: 'POST'
                    })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById(`views-${mediaId}`).innerText = data.views;
                    });
            });
        });

        // Stop media playback when the modal is closed
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            modal.addEventListener('hidden.bs.modal', function() {
                const mediaId = modal.id.split('-')[1]; // Extract the id from modal id
                const video = document.getElementById(`video-${mediaId}`);
                const audio = document.getElementById(`audio-${mediaId}`);

                // Pause video if it exists
                if (video) {
                    video.pause();
                    video.currentTime = 0; // Optional: reset to start
                }

                // Pause audio if it exists
                if (audio) {
                    audio.pause();
                    audio.currentTime = 0; // Optional: reset to start
                }
            });
        });
    });
</script>  
