<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Web based FTP Client &middot; Amazon S3 File browser &middot; Online FTP</title>
    <meta name="description" content="Manage and edit your FTP or Amazon S3 files directly in your browser."/>

    <link rel="stylesheet" href="/css/app.css">
    <style>
        html, body {
            height: 100%;
            min-height: 100%;
        }

        #login {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

            background: #457fca;
            background: -webkit-linear-gradient(to left, #457fca, #5691c8);
            background: linear-gradient(to left, #457fca, #5691c8);
        }

        #login > .container {
            width: 380px;
            max-width: 80%;
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

        .form-control {
            max-width: 100%;
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

        .disclaimer {
            font-size: 11px;
            text-align: center;
        }

        .copyright {
            position: absolute;
            bottom: 2em;
            font-size: 12px;
            width: 100%;
            text-align: center;
        }

        .copyright a {
            color: rgba(255, 255, 255, .6);
        }

        .copyright a:hover {
            color: rgba(255, 255, 255, 1);
        }

        @media screen and (max-width: 479px) {
            .forms {
                overflow: hidden;
                width: 200%;
            }

            .forms > div {
                float: left;
                width: 50%;
            }

            .container__inner {
                padding: 1.5em .5em 1em;
            }
        }
    </style>
</head>
<body id="login">
<div class="container">
    <div class="services">
        <div data-driver="ftp" data-offset="0" class="@if(old('driver') !== 's3') active @endif">FTP</div>
        <div data-driver="s3" data-offset="50" class="@if(old('driver') === 's3') active @endif">S3</div>
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

            <p class="disclaimer">
                Your login data is deleted as soon as you end your session.<br/>
                <a href="https://github.com/OFFLINE-GmbH/Online-FTP/blob/master/app/Helpers/LoginHandler.php#L11"
                   target="_blank">
                    All session data is stored encrypted.
                </a>
            </p>

            <input type="hidden" id="driver" value="{{ old('driver') ? old('driver') : 'ftp' }}" name="driver">
        </form>
    </div>
</div>

<div class="copyright">
    <a href="https://offline.swiss">Created by OFFLINE GmbH</a>
</div>

<script>
    [].forEach.call(document.querySelectorAll('[data-offset]'), function (el) {
        el.addEventListener('click', function () {
            document.getElementsByClassName('forms')[0].style.transform = 'translateX(-' + this.dataset.offset + '%)';

            [].forEach.call(document.getElementsByClassName('active'), function (el) {
                el.classList.remove('active');
            });

            document.getElementById('driver').value = this.dataset.driver;

            this.classList.add('active');
        });
    });
</script>
@includeIf('partials.github-ribbon')
@includeIf('partials.analytics')
</body>
</html>