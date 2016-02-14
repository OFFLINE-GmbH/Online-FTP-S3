import Vue from 'vue'
import App from './app.vue'

import store from './store'


new Vue({
    el: 'body',
    components: {
        app: App
    }
});

store.actions.fetchFiles('/');