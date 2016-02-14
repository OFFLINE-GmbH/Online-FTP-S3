import Vue from 'vue'
import Vuex from 'vuex'

import * as actions from './actions'
import mutations from './mutations'

const state = {
    files: [],
    path: 'public_html/test/dir',
    isLoading: false,
    allSelected: false,
    visibleModals: {
        confirmDelete: false
    }
};

Vue.use(Vuex);

export default new Vuex.Store({
    state,
    mutations,
    actions
});