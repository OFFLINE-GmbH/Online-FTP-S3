<style>
    .toolbar {
        margin-bottom: 20px;
    }
</style>

<template>
    <div class="toolbar col-md-12">
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary">Upload</button>
            <button @click.prevent="download" type="button" class="btn btn-primary">Download</button>
        </div>
        <div class="btn-group" role="group">
            <button @click.prevent="toggleModal('create')" type="button" class="btn btn-default">Create</button>
        </div>
        <div class="btn-group pull-right" role="group">
            <button @click.prevent="toggleModal('confirmDelete')" type="button" class="btn btn-danger"
                    :class="{disabled: ! hasSelectedFiles}">
                Delete
            </button>
        </div>
        <div class="btn-group" role="group">
            <button @click="refresh" type="button" class="btn btn-default">Refresh
            </button>
        </div>
    </div>
</template>

<script type="text/babel">
    import store from '../store';

    export default {
        methods: {
            toggleModal(key) {
                store.actions.toggleModal(key);
            },
            download(key) {
                store.actions.downloadSelected();
            },
            refresh() {
                store.actions.refresh();
            }
        },
        computed: {
            hasSelectedFiles() {
                return !! store.state.files.filter((file) => file.checked).length > 0
            }
        }
    }
</script>