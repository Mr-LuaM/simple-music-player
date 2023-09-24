<!-Playlist modal->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <br>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <?php foreach ($playlists as $playlist): ?>

                                <div class="playlist-item">
                                    <a href="/playlist/<?= $playlist['playlist_id'] ?>" class="playlist-link">
                                        <?= $playlist['name'] ?>
                                    </a>


                                    <!-- <a href="/edit_playlist/<?= $playlist['playlist_id'] ?>" class="btn btn-primary btn-sm">Edit</a> -->
                                    <a href="/delete_playlist/<?= $playlist['playlist_id'] ?>"
                                        class="btn btn-danger btn-sm">Delete</a>

                                </div>
                            <?php endforeach ?>

                        </div>
                    </div>



                </div>
                <div class="modal-footer">


                    <!-- Create Playlist Form -->
                    <form action="/create_playlist" method="post">
                        <div class="input-group">
                            <input type="text" name="playlist_name" class="form-control"
                                placeholder="Enter playlist name" value="<?= $playlist_records['name'] ?>" required>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>