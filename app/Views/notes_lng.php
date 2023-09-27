<!DOCTYPE html>
<html>
<head>
    <title>Music Player with Playlist</title>
</head>
<body>
    <h1>My Music Player</h1>

    <!-- Music Player Controls -->
    <audio id="music-player" controls>
        Your browser does not support the audio element.
    </audio>

    <!-- Playlist -->
    <div id="playlist">
        <h2>Playlist</h2>
        <ul id="playlist-list">
            <!-- Playlist items will be added here -->
        </ul>
    </div>

    <!-- Upload Music -->
    <h2>Upload Music</h2>
    <form id="upload-form" enctype="multipart/form-data">
        <input type="file" id="music-file" name="music-file" accept=".mp3">
        <button type="submit">Upload</button>
    </form>

    <!-- Create Playlist -->
    <h2>Create Playlist</h2>
    <input type="text" id="playlist-name" placeholder="Playlist Name">
    <button id="create-playlist">Create</button>

    <!-- Search Music -->
    <h2>Search Music</h2>
    <input type="text" id="search-input" placeholder="Search">
    <button id="search-button">Search</button>

    <!-- Search results will be displayed here -->
    <div id="search-results"></div>

    <!-- JavaScript -->
    <script src="script.js"></script>
</body>
</html>
