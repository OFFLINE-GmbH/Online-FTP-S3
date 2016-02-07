export default {

    SET_LOADING (state, isLoading) {
        console.log('setting loading', isLoading);
        state.isLoading = isLoading
    },

    SET_FILELIST(state, files) {
        state.files = files;
    },

    SET_PATH(state, path) {
        state.path = path;
    }

};