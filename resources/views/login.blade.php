<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Online FTP</title>
    <link rel="stylesheet" href="/css/app.css">
    <style>
        html, body {
            height: 100%;
            min-height: 100%;
        }

        #login {
            display: flex;
            align-items: center;
            justify-content: center;

            background: #457fca;
            background: -webkit-linear-gradient(to left, #457fca , #5691c8);
            background: linear-gradient(to left, #457fca , #5691c8);
        }

        #login > .container {
            flex: 0 0 380px;
            padding: 2em 2em 1em;
            border-radius: 4px;
            box-shadow: 0 2px 8px rgba(0,0,0,.2);

            background: #fff;
            background: -webkit-linear-gradient(to bottom, #fff , #fafafa);
            background: linear-gradient(to bottom, #fff , #fafafa);
        }

        .badge-danger {
            background-color: #d9534f;
        }

        #btn-login {
            display: block;
            width: 100%;
        }
    </style>
</head>
<body id="login">
    <div class="container">
        @include('login/form')
    </div>
</body>
</html>