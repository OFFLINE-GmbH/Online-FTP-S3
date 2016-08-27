<template>
    <div id="app" :class="{'editor-visible' : editorVisible}">
        <loading-overlay :visible="isLoading"></loading-overlay>
        <modals></modals>

        <browser></browser>
        <editor :visible="editorVisible"></editor>

        <iframe src="about:blank" style="display: none" id="download-frame"></iframe>
    </div>
</template>

<script>
    import Editor from './components/editor.vue';
    import Browser from './components/browser.vue';
    import Modals from './components/modals/index.vue'
    import LoadingOverlay from './components/loading-overlay.vue'

    import store from './store';

    export default {
        computed: {
            isLoading() {
                return store.state.isLoading;
            },
            editorVisible() {
                return store.state.editorVisible;
            }
        },
        components: {
            Editor,
            Browser,
            Modals,
            LoadingOverlay
        }
    }
</script>

<style>
    .col-browser {
        position: relative;
        width: 80%;
        left: 10%;
        padding: 1em;
        float: left;

        transition: .2s ease-out;
        transition-property: width, margin, left;
    }

    .col-editor {
        left: 100%;
        height: 100%;
        width: 50%;
        position: fixed !important;
        visibility: hidden;
        opacity: 0;

        transition: .2s ease-out;
        transition-property: visibility, opacity, left;
    }

    .editor-visible .col {
        position: relative;
        width: 50%;
    }

    .editor-visible .col-browser {
        width: 50%;
        left: 0;
    }

    .editor-visible .col-editor {
        visibility: visible;
        opacity: 1;
        left: 50%;
    }
</style>