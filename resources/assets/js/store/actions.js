import * as api from '../api'

export const setLoading = ({dispatch}, isLoading) => {
    dispatch('SET_LOADING', isLoading)
};

export const setPath = ({dispatch}, path) => {
    dispatch('SET_PATH', path)
};

export const fetchFiles = ({dispatch, actions}, path) => {
    dispatch('SET_LOADING', true);
    actions.setPath(path);
    api.getFiles(path, (files) => {
        actions.setFilelist(files);
    });
};

export const toggleFile = ({dispatch}, file) => {
    dispatch('TOGGLE_FILE', file);
};

export const changeDirectoryRelative = ({state, actions}, path) => {
    path = state.path += path + '/';
    actions.changeDirectory(path);
};

export const changeDirectory = ({dispatch, actions}, path) => {
    dispatch('SET_PATH', path);
    actions.fetchFiles(path);
};

export const setFilelist = ({dispatch}, files) => {
    dispatch('SET_LOADING', false);
    dispatch('SET_FILELIST', files);
};