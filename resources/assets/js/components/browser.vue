<template>
    <div class="col col-browser">
        <breadcrumbs></breadcrumbs>
        <toolbar></toolbar>
        <file-list></file-list>
    </div>
</template>

<script type="text/babel">
    import Breadcrumbs from './breadcrumbs.vue'
    import Toolbar from './toolbar.vue'
    import FileList from './filelist.vue'

    import store from './../store'

    export default {
        computed: {
            isLoading() {
                return store.state.isLoading;
            }
        },
        components: {
            Breadcrumbs,
            Toolbar,
            FileList
        }
    }
</script>