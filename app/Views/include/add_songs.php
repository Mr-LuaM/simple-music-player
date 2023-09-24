<div class="modal fade" id="manageSongsModal" tabindex="-1" aria-labelledby="manageSongsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="manageSongsModalLabel">Manage Songs</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- Inside the Manage Songs Modal -->
                <form action="/upload" method="post" enctype="multipart/form-data">

                    <!-- Hidden input for music_id if needed for editing -->
                    <input type="hidden" name="music_id" value="">

                    <!-- <div class="mb-3">
                        <label for="songTitle" class="form-label">Song Title</label>
                        <input type="text" class="form-control" id="songTitle" name="title" required>
                    </div>

                    <div class="mb-3">
                        <label for="artist" class="form-label">Artist</label>
                        <input type="text" class="form-control" id="artist" name="artist" required>
                    </div> -->

                    <div class="mb-3">
                        <label for="file" class="form-label">Song File (MP3 or WAV)</label>
                        <input type="file" class="form-control" name="song" required>
                    </div>



                    <button type="submit" class="btn btn-success">Add Song</button>
                </form>
            </div>
            <div class="modal-footer bg-dark">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>