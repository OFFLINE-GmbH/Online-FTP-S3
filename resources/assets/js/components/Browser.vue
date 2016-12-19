<template>
    <div class="col col-browser">
        <breadcrumbs></breadcrumbs>
        <toolbar></toolbar>
        <file-list></file-list>
    </div>
</template>

<script type="text/babel">
    import Breadcrumbs from './layout/Breadcrumbs.vue'
    import Toolbar from './layout/Toolbar.vue'
    import FileList from './filelist/FileList.vue'

    import * as types from '../store/types'
    import { mapActions, mapState } from 'vuex'

    export default {
        computed: {
            ...mapState({
                isLoading: state => state.isLoading
            })
        },
        components: {
            Breadcrumbs,
            Toolbar,
            FileList
        }
    }
</script>