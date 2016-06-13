<template>
    <div id="loading-overlay" v-show="visible"></div>
</template>

<script>
    export default {
        props: ['visible']
    }
</script>

<style>
    #loading-overlay {
        position: fixed;
        left: 0;
        top: 0;
        width: 100vw;
        height: 100vw;
        z-index: 1000;
        background: rgba(255, 255, 255, .3);
    }
</style>