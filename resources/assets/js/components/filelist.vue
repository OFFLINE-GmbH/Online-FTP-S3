<template>
    <div class="row">
        <div class="listing col-md-12">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th colspan="2"></th>
                    <th>Filename</th>
                    <th>Permissions</th>
                    <th>Filesize</th>
                    <th>Last modified</th>
                </tr>
                <tr>
                    <td><input @change.prevent="toggleAll" v-model="allSelected" type="checkbox"></td>
                    <td>
                        <span v-if="! isRootLevel" class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span>
                    </td>
                    <td colspan="4">
                        <a v-if="! isRootLevel" href="#" @click.prevent="levelUp">One level up</a>
                    </td>
                </tr>
                </thead>
                <tbody>
                <tr is="file-list-entry" :item="item" v-for="item in listing"></tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script type="text/babel">
    import FileListEntry from './filelistentry.vue'

    import store from './../store';

    export default {
        methods: {
            levelUp() {
                store.actions.levelUp();
            },
            toggleAll() {
                store.actions.toggleAll(!store.state.allSelected);
            }
        },
        computed: {
            listing() {
                return store.state.files;
            },
            isRootLevel() {
                return store.state.path === '/';
            },
            allSelected() {
                return store.state.allSelected;
            }
        },
        components: {
            FileListEntry
        }
    }
</script>

<style>
    .listing td:nth-child(1),
    .listing td:nth-child(2) {
        width: 10px;
    }
</style>