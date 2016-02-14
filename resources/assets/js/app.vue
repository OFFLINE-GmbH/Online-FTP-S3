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

    export default {
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
    }
    .col-browser {
        padding: 1em;
    }
</style>