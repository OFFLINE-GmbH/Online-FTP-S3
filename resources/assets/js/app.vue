<template>
    <loading-overlay :visible="state.isLoading"></loading-overlay>
    <div class="container">
        <div class="row">
            <breadcrumbs :path="state.path"></breadcrumbs>
        </div>
        <div class="row">
            <toolbar></toolbar>
        </div>

        <div class="row">
            <file-list :listing="state.files"></file-list>
        </div>
    </div>
</template>

<script>
    import Breadcrumbs from './components/breadcrumbs.vue'
    import Toolbar from './components/toolbar.vue'
    import FileList from './components/filelist.vue'
    import LoadingOverlay from './components/loading-overlay.vue'

    import store from './store';

    export default {
        data() {
            return {
                state: store
            }
        },
        components: {
            Breadcrumbs,
            Toolbar,
            FileList,
            LoadingOverlay
        }
    }
</script>