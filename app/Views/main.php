<!DOCTYPE html>
<html lang="en">

<body>

  <?php include 'include/add_songs.php';
  include 'include/top.php';
  include 'include/playlist_modal.php';
  include 'include/add2playlist.php';
  ?>



  <!-- In your view where the search form is displayed -->
  <form action="/search" method="get">
    <input type="search" name="search" placeholder="Search song">
    <input type="hidden" name="context" value="<?= $context ?>">

    <?php if ($context === 'playlist'): ?>
      <!-- Include the playlistID parameter when in a playlist context -->
      <input type="hidden" name="playlistID" value="<?= $playlist['playlist_id'] ?>">
    <?php endif ?>

    <button type="submit" class="btn btn-primary">Search</button>
  </form>

  <h1>Music Player</h1>
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    My Playlist
  </button>

  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#manageSongsModal">
    Manage Songs
  </button>

  <audio id="audio" controls autoplay></audio>
  <ul id="playlist">
    <?php foreach ($music as $musicItem): ?>
      <li data-src="<?= base_url('/uploads/songs/' . $musicItem['file_path']) ?>">
        <?= $musicItem['title'] ?>
      </li>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal"
        onclick="setMusicID('<?= $musicItem['music_id'] ?>')">
        <i class="fas fa-plus"></i>+
      </button>
    <?php endforeach ?>
  </ul>











  <script>
    $(document).ready(function () {
      // Get references to the button and modal
      const modal = $("#myModal");
      const modalData = $("#modalData");
      const musicID = $("#musicID");
      // Function to open the modal with the specified data
      function openModalWithData(dataId) {
        // Set the data inside the modal content
        modalData.text("Data ID: " + dataId);
        musicID.val(dataId);
        // Display the modal
        modal.css("display", "block");
      }

      // Add click event listeners to all open modal buttons

      // When the user clicks the close button or outside the modal, close it
      modal.click(function (event) {
        if (event.target === modal[0] || $(event.target).hasClass("close")) {
          modal.css("display", "none");
        }
      });
    });
  </script>
  <script>
    const audio = document.getElementById('audio');
    const playlist = document.getElementById('playlist');
    const playlistItems = playlist.querySelectorAll('li');

    let currentTrack = 0;

    function playTrack(trackIndex) {
      if (trackIndex >= 0 && trackIndex < playlistItems.length) {
        const track = playlistItems[trackIndex];
        const trackSrc = track.getAttribute('data-src');
        audio.src = trackSrc;
        audio.play();
        currentTrack = trackIndex;
      }
    }

    function nextTrack() {
      currentTrack = (currentTrack + 1) % playlistItems.length;
      playTrack(currentTrack);
    }

    function previousTrack() {
      currentTrack = (currentTrack - 1 + playlistItems.length) % playlistItems.length;
      playTrack(currentTrack);
    }

    playlistItems.forEach((item, index) => {
      item.addEventListener('click', () => {
        playTrack(index);
      });
    });

    audio.addEventListener('ended', () => {
      nextTrack();
    });

    playTrack(currentTrack);
  </script>
  <script>
    function setMusicID(musicID) {
      // Set the value of the hidden input field
      document.getElementById('musicID').value = musicID;
    }
  </script>
</body>

</html>