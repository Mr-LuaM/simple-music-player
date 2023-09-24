<!-- Playlist Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">My Playlists</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php foreach ($playlists as $playlist): ?>
                            <div class="playlist-item d-flex justify-content-between align-items-center mb-3">
                                <a href="/playlist/<?= $playlist['playlist_id'] ?>?playlistID=<?= $playlist['playlist_id'] ?>"
                                    class="playlist-link">
                                    <?= $playlist['name'] ?>
                                </a>

                                <a href="/delete_playlist/<?= $playlist['playlist_id'] ?>" class="btn btn-danger btn-sm">
                                    Delete
                                </a>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Create Playlist Form -->
                <form action="/create_playlist" method="post">
                    <div class="input-group">
                        <input type="text" name="playlist_name" class="form-control" placeholder="Enter playlist name"
                            value="<?= $playlist_records['name'] ?>" required>
                        <button type="submit" class="btn btn-success">Create</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-dark">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>