<template>
    <div class="col col-editor">
        <div id="editor">{{ contents }}</div>
        <div id="hide">
            <button type="button" class="btn btn-default btn-sm" @click="hide" title="Hide editor">
                <span class="glyphicon glyphicon-arrow-right"></span>
            </button>
        </div>
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
    import * as types from '../store/types'
    import { mapActions, mapState } from 'vuex'
    export default {
        data() {
            return {
                editor: null
            }
        },
        methods: {
            ...mapActions({
                download: types.DOWNLOAD_OPEN_FILE,
                putContents: types.PUT_CONTENTS
            }),
            setEditorVisibility(visibility) {
                this.$store.commit(types.SET_EDITOR_VISIBILITY, visibility)
            },
            save() {
                this.putContents(this.editor.getValue());
            },
            hide() {
                this.setEditorVisibility(false);
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
        mounted() {
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
        destroyed() {
            this.editor.destroy()
        },
        computed: {
            ...mapState({
                contents: state => state.editorContents,
                contentsChanged: state => state.editorContentsChanged,
                openFile: state => state.openFile,
            })
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

    #hide {
        position: absolute;
        top: 50%;
        left: 0;
        transform: translate(-50%, 0);
        z-index: 2000;
    }

    @media screen and (max-width: 880px) {
        #hide {
            transform: translate(10%, 0);
        }
    }
</style>