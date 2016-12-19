/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'
import App from './app.vue'

import store from './store'

import * as types from './store/types'

const vm = new Vue({
    el: '#main',
    store,
    components: {
        app: App
    }
});

vm.$store.dispatch(types.FETCH_FILES, '/');