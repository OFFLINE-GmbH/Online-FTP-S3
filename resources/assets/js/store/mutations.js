export default {

    SET_LOADING (state, isLoading) {
        state.isLoading = isLoading
    },

    SET_FILELIST(state, files) {
        state.files = files;
    },

    TOGGLE_FILE(state, file) {
        file.checked = ! file.checked;
    },

    SET_PATH(state, path) {
        state.path = path;
    },

    TOGGLE_MODAL(state, modal) {
        state.visibleModals[modal] = ! state.visibleModals[modal];
    }

};