<template>
    <div class="row">
        <div class="toolbar col-md-12">
            <div class="btn-group" role="group">
                <button @click.prevent="toggleModal('upload')" type="button" class="btn btn-primary">
                    Upload
                </button>
                <button @click.prevent="download" type="button" class="btn btn-primary">
                    Download
                </button>
            </div>
            <div class="btn-group" role="group">
                <button @click.prevent="toggleModal('create')" type="button" class="btn btn-default">
                    Create
                </button>
            </div>
            <div class="btn-group pull-right" role="group">
                <button @click.prevent="toggleModal('confirmDelete')" type="button" class="btn btn-danger"
                        :class="{disabled: ! hasSelectedFiles}">
                    Delete
                </button>
            </div>
            <div class="btn-group" role="group">
                <button @click.prevent="refresh" type="button" class="btn btn-default">
                    Refresh
                </button>
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
    import * as types from '../../store/types'
    import {mapActions, mapState} from 'vuex'

    export default {
        methods: {
            ...mapActions({
               download: types.DOWNLOAD_SELECTED,
               refresh: types.REFRESH,
            }),
            toggleModal(identifier) {
                this.$store.commit(types.TOGGLE_MODAL, identifier);
            }
        },
        computed: {
            ...mapState({
                hasSelectedFiles: state => state.files.filter(file => file.checked).length > 0
            })
        }
    }
</script>

<style>
    .toolbar {
        margin-bottom: 20px;
    }
</style>
