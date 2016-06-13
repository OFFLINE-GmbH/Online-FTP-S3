<template>
    <loading-overlay :visible="isLoading"></loading-overlay>
    <modals></modals>

    <browser></browser>
    <editor></editor>
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
    .col {
        width: 50%;
        float: left;
        position: relative;
    }
    .col-browser {
        padding: 1em;
    }
    .col-editor {
        position: fixed;
        left: 50%;
    }
</style>