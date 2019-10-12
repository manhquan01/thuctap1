<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap and FontAwesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <!-- FM -->
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>File manager</title>
</head>
<body>

<div style="height: 600px;">
    <div id="fm"></div>
</div>

<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
</body>
</html>
