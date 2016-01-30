<!doctype html>
<html lang="de" ng-app="onlineftp">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/app.css"/>

    <script src="vendor/jquery/dist/jquery.min.js"></script>
    <title>Online FTP</title>
</head>
<body>
<div class="container-fluid" id="app"></div>

<script>var WEBROOT = '{{ app('url')->to('/api') }}';</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="bundle.js"></script>
</body>
</html>
