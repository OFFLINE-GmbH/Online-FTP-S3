<style lang="stylus">
    .toolbar
        margin-bottom 20px
</style>

<template>
    <div class="toolbar col-md-12">
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary">Upload</button>
            <button type="button" class="btn btn-primary">Download</button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default">Create</button>
            <button type="button" class="btn btn-default">Move</button>
        </div>
        <div class="btn-group pull-right" role="group">
            <button type="button" class="btn btn-danger">Delete</button>
        </div>
        <div class="btn-group" role="group">
            <button @click="reload" type="button" class="btn btn-default">Reload
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            reload() {
                console.log(this.$root);
            }
        }
    }
</script>