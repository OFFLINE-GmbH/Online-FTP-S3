/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'
import App from './app.vue'
import Adsense from 'vue-google-adsense/dist/Adsense.min.js'

Vue.use(require('vue-script2'))
Vue.use(Adsense)

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
