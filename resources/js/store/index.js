import Vue from 'vue'
import Vuex from 'vuex'

import actions from './actions'
import mutations from './mutations'

const state = {
    files: [],
    openFile: null,
    path: '/',
    isLoading: false,
    allSelected: false,
    editorContents: '',
    editorVisible: false,
    editorContentsChanged: 0, // Updated file change to trigger editor's watch method
    visibleModals: {
        confirmDelete: false,
        create: false,
        upload: false
    }
};

Vue.use(Vuex);

export default new Vuex.Store({
    state,
    mutations,
    actions
});