<style>
    #loading-overlay {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        z-index: 1000;
        background: rgba(255, 255, 255, .3);
    }
</style>

<template>
    <div id="loading-overlay" v-show="visible"></div>
</template>

<script>
    export default {
        props: ['visible']
    }
</script>