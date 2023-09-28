<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Player</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/include/styles.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?= base_url('public/include/js/script.js') ?>"></script>

    <style>
      .hakdog{
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f5f5f5;
            padding: 20px;
        }
        
        #player-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        audio {
            width: 100%;
        }

        #playlist {
            list-style: none;
            padding: 0;
        }

        #playlist li {
            cursor: pointer;
            padding: 10px;
            background-color: #eee;
            margin: 5px 0;
            transition: background-color 0.2s ease-in-out;
        }

        #playlist li:hover {
            background-color: #ddd;
        }

        #playlist li.active {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>

