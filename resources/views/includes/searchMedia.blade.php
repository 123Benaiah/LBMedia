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
