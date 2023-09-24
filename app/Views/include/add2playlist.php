<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">Select from playlist</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form action="/addtoplaylist" method="post">
                    <input type="hidden" id="musicID" name="musicID" value="">
                    <div class="mb-3">
                        <label for="playlistSelect" class="form-label">Select Playlist</label>
                        <select name="playlist" class="form-select">
                            <?php foreach ($playlists as $playlist): ?>
                                <option value="<?= $playlist['playlist_id'] ?>">
                                    <?= $playlist['name'] ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer bg-dark">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>