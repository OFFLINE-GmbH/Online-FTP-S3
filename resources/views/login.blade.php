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
            background: -webkit-linear-gradient(to left, #457fca, #5691c8);
            background: linear-gradient(to left, #457fca, #5691c8);
        }

        #login > .container {
            width: 380px;
            border-radius: 4px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .2);

            background: #fff;
            background: -webkit-linear-gradient(to bottom, #fff, #fafafa);
            background: linear-gradient(to bottom, #fff, #fafafa);
        }

        .container__inner {
            padding: 1.5em 1.5em 1em;
        }

        .badge-danger {
            background-color: #d9534f;
        }

        #btn-login {
            display: block;
            width: 100%;
        }

        #form {
            overflow: hidden;
        }

        .forms {
            overflow: hidden;
            width: calc(308px * 2);
        }

        .forms > div {
            float: left;
            width: 308px;
        }

        .services {
            display: flex;
            border-bottom: 1px solid #e0e0e0;
            box-shadow: inset 0 0 7px rgba(0, 0, 0, .1);
            margin: 0 -15px;
        }

        .services > div {
            flex: 1;
            text-align: center;
            padding: 1em;
            cursor: pointer;
            background: rgba(255, 255, 255, .1);
            opacity: .4;
            transition: .2s ease-out opacity;
        }

        .services > div:not(.active):hover {
            opacity: .8;
        }

        .services > .active {
            opacity: 1;
            background: rgba(0, 0, 0, .05);
        }
    </style>
</head>
<body id="login">
<div class="container">
    <div class="services">
        <div data-driver="ftp" data-offset="0" class="@if(old('driver') === 'ftp' or old('driver') === null) active @endif">FTP</div>
        <div data-driver="s3" data-offset="308" class="@if(old('driver') === 's3') active @endif">S3</div>
    </div>
    <div class="container__inner">
        <form action="/login" method="POST" id="form">
            @if($errors->has('connection'))
                <div class="alert alert-danger text-center">
                    {{ $errors->get('connection')[0] }}
                </div>
            @endif
            <div class="forms"
                @if(old('driver') === 's3')
                    style="transform: translateX(-308px)"
                @endif
            >
                <div class="ftp">
                    @include('login/ftp')
                </div>
                <div class="s3">
                    @include('login/s3')
                </div>
            </div>
            <input type="hidden" id="driver" value="{{ old('driver') or 'ftp' }}" name="driver">
        </form>
    </div>
</div>
<script>
    [].forEach.call(document.querySelectorAll('[data-offset]'), function (el) {
        el.addEventListener('click', function () {
            document.getElementsByClassName('forms')[0].style.transform = 'translateX(-' + this.dataset.offset + 'px)';

            [].forEach.call(document.getElementsByClassName('active'), function (el) {
                el.classList.remove('active');
            });

            document.getElementById('driver').value = this.dataset.driver;

            this.classList.add('active');
        });
    });
</script>
</body>
</html>