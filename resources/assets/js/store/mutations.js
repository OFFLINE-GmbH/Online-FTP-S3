export default {

    SET_LOADING (state, isLoading) {
        state.isLoading = isLoading
    },

    SET_FILELIST(state, files) {
        state.files = files;
    },

    SET_ALL_SELECTED(state, newState) {
        state.allSelected = newState;
    },

    TOGGLE_FILE(state, file, forceState) {
        if (forceState) {
            file.checked = forceState;
        } else {
            file.checked = !file.checked;
        }
    },

    SET_PATH(state, path) {
        state.path = path;
    },

    TOGGLE_MODAL(state, modal) {
        state.visibleModals[modal] = !state.visibleModals[modal];
    }

};