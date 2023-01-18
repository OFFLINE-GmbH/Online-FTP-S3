import * as types from './types';
import Vue from 'vue'

export default {

    [types.SET_LOADING] (state, isLoading) {
        state.isLoading = isLoading
    },

    [types.SET_FILELIST](state, files) {
        state.files = files;
    },

    [types.SET_EDITOR_CONTENTS](state, contents) {
        state.editorContents = contents;
        state.editorContentsChanged = +Date.now();
    },

    [types.SET_EDITOR_VISIBILITY](state, visibility) {
        state.editorVisible = visibility;
    },

    [types.SET_OPEN_FILE](state, path) {
        state.openFile = path;
    },

    [types.SET_ALL_SELECTED](state, newState) {
        state.allSelected = newState;
    },

    [types.TOGGLE_FILE](state, {file, newState}) {
        if (typeof newState === 'undefined') {
            newState = !file.checked;
        }

        file.checked = newState;
    },

    [types.SET_PATH](state, path) {
        state.path = path;
    },

    [types.TOGGLE_MODAL](state, modal) {
        Vue.set(state.visibleModals, modal, !state.visibleModals[modal]);
    }

};