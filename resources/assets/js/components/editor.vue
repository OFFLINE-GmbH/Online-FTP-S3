<template>
    <div class="col col-editor">
        <div id="editor">Click on a file to edit it.</div>
    </div>
</template>

<script type="text/babel">
    export default {
        data() {
            return {
                editor: null,
            }
        },
        ready() {
            this.editor = window.ace.edit('editor');
            this.editor.setTheme("ace/theme/tomorrow_night");
            this.editor.setHighlightActiveLine(true);
            this.editor.getSession().setTabSize(4);

        }
    }
</script>

<style>
    #editor {
        position: relative;
        width: 100%;
        z-index: 500;
        height: 100vh;
        font-size: 15px;
        line-height: 1.6;
    }
</style>