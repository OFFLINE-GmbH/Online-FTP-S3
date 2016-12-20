<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ session('host') }}</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
<div id="main">
    <app></app>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.3/ace.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.3/ext-language_tools.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.3/ext-modelist.js"></script>
<script>
    window.Laravel = {
        host: '{{ session('host') }}',
        csrfToken: '{{ csrf_token() }}'
    }
</script>
<script src="/js/app.js"></script>

@includeIf('partials.github-ribbon')
@includeIf('partials.analytics')
</body>
</html>