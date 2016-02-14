<template>
    <loading-overlay :visible="isLoading"></loading-overlay>
    <modal-delete></modal-delete>
    <modal-create></modal-create>
    <div class="container">
        <div class="row">
            <breadcrumbs></breadcrumbs>
        </div>
        <div class="row">
            <toolbar></toolbar>
        </div>

        <div class="row">
            <file-list></file-list>
        </div>
    </div>
</template>

<script>
    import Breadcrumbs from './components/breadcrumbs.vue'
    import Toolbar from './components/toolbar.vue'
    import FileList from './components/filelist.vue'
    import LoadingOverlay from './components/loading-overlay.vue'
    import ModalDelete from './components/modals/modal-delete.vue'
    import ModalCreate from './components/modals/modal-create.vue'

    import store from './store'

    export default {
        computed: {
          isLoading() {
              return store.state.isLoading;
          }
        },
        components: {
            Breadcrumbs,
            Toolbar,
            FileList,
            LoadingOverlay,
            ModalDelete,
            ModalCreate,
        }
    }
</script>