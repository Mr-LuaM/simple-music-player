<!-- Display the playlist name -->
<h2>
    <?= $playlist['name'] ?>
</h2>

<!-- Display the music tracks for the playlist -->
<ul id="playlist">
    <?php foreach ($music as $musicItem): ?>
        <li data-src="<?= base_url('/uploads/songs/' . $musicItem->file_path) ?>">
            <?= $musicItem->title ?>
        </li>
        <!-- Add any additional content or buttons specific to this playlist's view -->
    <?php endforeach ?>
</ul>