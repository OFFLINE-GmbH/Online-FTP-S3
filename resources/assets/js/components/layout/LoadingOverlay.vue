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
        cursor: wait;
        left: 0;
        top: 0;
        width: 100vw;
        height: 100%;
        z-index: 10000;
        background: rgba(255, 255, 255, .3);
    }
</style>