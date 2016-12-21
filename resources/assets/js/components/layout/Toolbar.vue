<template>
    <div class="row">
        <div class="toolbar">
            <div class="col-md-10 col-xs-10">
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
                <div class="btn-group" role="group">
                    <button @click.prevent="refresh" type="button" class="btn btn-default">
                        Refresh
                    </button>
                </div>
            </div>
            <div class="col-md-2 col-xs-2 text-right">
                <div class="btn-group" role="group">
                    <button @click.prevent="toggleModal('confirmDelete')" type="button" class="btn btn-danger"
                            :class="{disabled: ! hasSelectedFiles}">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
    import * as types from '../../store/types'
    import { mapActions, mapState } from 'vuex'

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
    @media screen and (max-width: 535px) {
        .toolbar .btn-group {
            display: block;
            width: 100%;
        }
        .toolbar .btn-group .btn {
            display: block;
            float: none;
            width: 100%;
            border-radius: 4px !important;
            margin: 2px 0;
        }
        .toolbar > div {
            width: 100% !important;
        }
    }
</style>
