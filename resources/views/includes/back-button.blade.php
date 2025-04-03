<style>
    /* Shaking animation */
    @keyframes shake {
        0% {
            transform: translateX(0);
        }

        25% {
            transform: translateX(-5px);
        }

        50% {
            transform: translateX(5px);
        }

        75% {
            transform: translateX(-5px);
        }

        100% {
            transform: translateX(0);
        }
    }

    .shake {
        animation: shake 0.5s ease-in-out;
        animation-iteration-count: 1;
        /* Shakes only once */
    }

    .audio-icon {
        color: rgb(174, 174, 4);
        /* Yellow for audio */
    }

    .image-icon {
        color: green;
        /* Green for image */
    }

    .video-icon {
        color: blue;

        #searchResults {
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
        }

        .list-group-item {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .list-group-item:last-child {
            border-bottom: none;
        }

        .list-group-item h6 {
            margin: 0;
            font-size: 16px;
        }

        .list-group-item small {
            color: #666;
        }
</style>
<script>
    // Add the shake effect on back button click
    document.getElementById('backButton').addEventListener('click', function() {
        // Add the shake class
        this.classList.add('shake');

        // Remove the shake class after the animation ends
        setTimeout(() => {
            this.classList.remove('shake');
            // Redirect to the index page (update the URL to match your index route if needed)
            window.location.href = "{{ route('media.index') }}"; // Adjust the route if necessary
        }, 500);
    });
</script>
<!-- Include GSAP -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

<script>
    gsap.to(".video-icon", {
        rotation: 360,
        scale: 1.2,
        duration: 2,
        repeat: -1,
        yoyo: true,
        ease: "power1.inOut"
    });
    // Audio Icon Bouncing Effect
    gsap.to(".audio-icon", {
        y: -5,
        duration: 0.5,
        repeat: -1,
        yoyo: true,
        ease: "power1.inOut"
    });

    // Image Icon Pulsing Effect
    gsap.to(".image-icon", {
        scale: 1.1,
        duration: 1,
        repeat: -1,
        yoyo: true,
        ease: "power1.inOut"
    });
</script>
