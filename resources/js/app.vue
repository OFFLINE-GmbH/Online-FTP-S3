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
    import Editor from './components/Editor.vue';
    import Browser from './components/Browser.vue';
    import Modals from './components/modals/Index.vue'
    import LoadingOverlay from './components/layout/LoadingOverlay.vue'

    import * as types from './store/types'
    import { mapActions, mapState } from 'vuex'

    export default {
        computed: {
            ...mapState({
                isLoading: state => state.isLoading,
                editorVisible: state => state.editorVisible,
            })
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
    a {
        cursor: pointer
    }

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

    .alertify-logs {
        z-index: 10001;
    }

    @media screen and (max-width: 880px) {
        .github-ribbon {
            display: none;
        }

        .editor-visible .col {
            width: 100%;
        }

        .editor-visible .col-browser {
            width: 100%;
        }

        .editor-visible .col-editor {
            left: 0%;
        }
    }
</style>