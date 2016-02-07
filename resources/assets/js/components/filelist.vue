<style lang="stylus">
    .listing
        td
            &:nth-child(1)
                width 10px
            &:nth-child(2)
                width 10px
</style>

<template>
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
                <td><input type="checkbox"></td>
                <td>
                    <span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span>
                </td>
                <td colspan="4">
                    <a href="#">One level up</a>
                </td>
            </tr>
            </thead>
            <tbody>
            <tr is="file-list-entry" :item="item" v-for="item in listing"></tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import FileListEntry from './filelistentry.vue'
    export default {
        props: ['listing'],
        components: {
            FileListEntry
        }
    }
</script>