export default {

    SET_LOADING (state, isLoading) {
        state.isLoading = isLoading
    },

    SET_FILELIST(state, files) {
        state.files = files;
    },

    SET_EDITOR_CONTENTS(state, contents) {
        state.editorContents = contents;
        state.editorContentsChanged = +Date.now();
    },

    SET_EDITOR_VISIBILITY(state, visibility) {
        state.editorVisible = visibility;
    },

    SET_OPEN_FILE(state, path) {
        state.openFile = path;
    },

    SET_ALL_SELECTED(state, newState) {
        state.allSelected = newState;
    },

    TOGGLE_FILE(state, file, newState) {
        if (typeof newState === 'undefined') {
            newState = !file.checked;
        }

        file.checked = newState;
    },

    SET_PATH(state, path) {
        state.path = path;
    },

    TOGGLE_MODAL(state, modal) {
        state.visibleModals[modal] = !state.visibleModals[modal];
    }

};