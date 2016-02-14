<template>
    <div class="col col-editor">
        <div id="editor">{{ contents }}</div>
        <div id="statusbar">
            <button type="button"
                    class="btn btn-primary"
                    title="Save file"
                    @click="save"
                    v-show="openFile !== null"
            >
                <span class="glyphicon glyphicon-floppy-disk"></span>
                Save file
            </button>
            <button type="button"
                    class="btn btn-default"
                    title="Download"
                    @click="download"
                    v-show="openFile !== null"
            >
                <span class="glyphicon glyphicon-download"></span>
            </button>
        </div>
    </div>
</template>

<script type="text/babel">
    import store from '../store';
    export default {
        data() {
            return {
                editor: null
            }
        },
        methods: {
            download() {
                store.actions.downloadOpen();
            },
            save() {
                store.actions.putContents(this.editor.getValue());
            }
        },
        watch: {
            contentsChanged() {
                this.editor.setValue(this.contents, -1);
            },
            openFile(newValue, oldValue) {
                if (oldValue !== newValue && newValue !== null) {
                    let modelist = window.ace.require('ace/ext/modelist');
                    let mode = modelist.getModeForPath(newValue).mode;
                    this.editor.getSession().setMode(mode);
                }
            }
        },
        ready() {
            this.editor = window.ace.edit('editor');
            this.editor.setOptions({
                theme: 'ace/theme/tomorrow_night',
                highlightActiveLine: true,
                displayIndentGuides: true,
                enableBasicAutocompletion: true,
                tabSize: 4
            });

            this.editor.$blockScrolling = Infinity;
        },
        computed: {
            contents() {
                return store.state.editorContents;
            },
            contentsChanged() {
                return store.state.editorContentsChanged;
            },
            openFile() {
                return store.state.openFile;
            }
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

    #statusbar {
        position: absolute;
        left: 0;
        bottom: 0;
        height: 54px;
        width: 100%;
        z-index: 600;
        padding: 10px;
    }
</style>