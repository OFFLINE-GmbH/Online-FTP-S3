<!doctype html>
<html lang="de" ng-app="onlineftp">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/build/styles.min.css"/>

    <script src="vendor/jquery/dist/jquery.min.js"></script>
    <title>Online FTP</title>
</head>
<body>
<Editor />
<div class="page-wrapper" id="app"></div>
<!--<script src="vendor/requirejs/require.js"></script>-->
<!--<script src="vendor/ace/src-min/ace.js"></script>-->
<!--<script src="vendor/ace/src-min/theme-chrome.js"></script>-->
<!--<script src="vendor/ace/src-min/mode-html.js"></script>-->

<script src="vendor/react/react.min.js"></script>
<script src="vendor/react/JSXTransformer.js"></script>
<script type="text/jsx;harmony=true" src="app/components/FileList.js"></script>
<script type="text/jsx;harmony=true" src="app/components/FileTree.js"></script>
<script type="text/jsx;harmony=true" src="app/components/Breadcrumbs.js"></script>
<script type="text/jsx;harmony=true" src="app/components/Toolbar.js"></script>
<script type="text/jsx;harmony=true" src="app/components/OnlineFtp.js"></script>
<script>
    //window.onload = function () {
    //    var editor = ace.edit('editor');
    //    var JavaScriptMode = require("ace/mode/javascript").Mode;
    //    editor.setTheme("ace/theme/chrome");
    //    editor.getSession().setMode(new JavaScriptMode());
    //}
</script>
</body>
</html>