<?= $this->include('layout/bootstrap') ?>

<body>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Playlists</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <br>
                        <ul class="list-unstyled mt-3">
                            <?php foreach ($playlists as $play) : ?>
                                <li>
                                    <a href="/playlists/<?= $play['id'] ?>">
                                        <?= $play['name'] ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#createPlaylist">Create New</button>
                    </div>
                </div>
            </div>
    </div>
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-light"><h4>Music Player</h4></a>
            <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active text-light" aria-current="page" href="http://localhost:8080/main_page">Home</a>
        </li>
      </ul>
    </div>
            <form class="d-flex" action="/search" method="get">
            <input class="form-control me-2" type="search" name = "title" placeholder="Search for a song" required aria-label="Search">
            <button class="btn btn-outline-dark text-light" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <br>
    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
            My Playlist
        </button>
        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#uploadSong">
            Upload Song
        </button>
    </div>
    <br>

    <audio id="audio" controls autoplay type="audio/mpeg"></audio>

    <div class = "hakdog">
    <ul class="list-unstyled mt-3" id="playlist">
        <?php foreach ($music as $mus) : ?>
            <li class="align-items-center d-grid gap-2 d-md-flex justify-content-md-center" data-src="/<?= $mus['file_path'] ?>">
                <a href="#" id="music" class="play-link" data-music-id="<?= $mus['id'] ?>">
                    <?= $mus['title'] ?>
                </a>
                <button class="open-modal btn btn-dark" data-target="#mymodal" data-toggle="modal" data-music-id="<?= $mus['id'] ?>">
                    Add
                </button>
            </li>
        <?php endforeach; ?>
    </ul>
    </div>


    
    <!-- Select from Playlist -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Select from playlist</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="/add" method="post">
                        <!-- <p id="modalData"></p> -->
                        <input type="hidden" id="musicID" name="musicID" value="">
                        <select name="playlist" class="form-control">
                            <?php foreach ($playlists as $play) : ?>
                                <option value="<?= $play['id'] ?>"><?= $play['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <br>
                        <input type="submit" name="add">
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Get references to the modal and form elements
            const modal = $("#myModal");
            const musicID = $("#musicID");

            // Function to open the modal with the specified music ID
            function openModalWithMusicID(dataId) {
                musicID.val(dataId);
                modal.modal("show"); // Use Bootstrap's modal("show") to display the modal
            }

            // Add click event listeners to all open-modal buttons
            $(".open-modal").click(function(event) {
                event.preventDefault(); // Prevent the default behavior of the anchor link
                const musicId = $(this).data("music-id");
                openModalWithMusicID(musicId);
            });

            // When the user clicks the close button or outside the modal, close it
            modal.on("hide.bs.modal", function() {
                musicID.val(""); // Clear the musicID input when closing the modal
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
                const trackTitle = track.textContent;
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

<!-- Create Playlist -->
    <div class="modal fade" id="createPlaylist" tabindex="-1" aria-labelledby="createPlaylistLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPlaylistLabel">Create Playlist</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createPlaylistForm" action="/create" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Playlist Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-dark" value="Create">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#createPlaylistButton').click(function() {
                var name = $('#name').val();
                $('#createPlaylist').modal('hide');
            });
        });
    </script>

    <!-- Upload Song-->
    <div class="modal fade" id="uploadSong" tabindex="-1" aria-labelledby="uploadSongLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadSongLabel">Upload a Song</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="\upload" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="artist" class="form-label">Artist</label>
                            <input type="text" class="form-control" id="artist" name="artist" required>
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">Song File (MP3)</label>
                            <input type="file" class="form-control" id="file" name="file" accept=".mp3" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>