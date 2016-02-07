<template>
    <loading-overlay :visible="isLoading"></loading-overlay>
    <div class="container">
        <div class="row">
            <breadcrumbs></breadcrumbs>
        </div>
        <div class="row">
            <toolbar></toolbar>
        </div>

        <div class="row">
            <file-list :listing="files"></file-list>
        </div>
    </div>
</template>

<script>
    import Breadcrumbs from './components/breadcrumbs.vue'
    import Toolbar from './components/toolbar.vue'
    import FileList from './components/filelist.vue'
    import LoadingOverlay from './components/loading-overlay.vue'

    import store from './store'

    export default {
        methods: {

        },
        computed: {
          files() {
              return store.state.files;
          },
          isLoading() {
              return store.state.isLoading;
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