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

export const changeDirectory = ({actions}, path) => {
    actions.fetchFiles(path);
};
export const toggleModal = ({dispatch}, modal) => {
    dispatch('TOGGLE_MODAL', modal);
};

export const levelUp = ({actions, state}) => {
    let path = state.path.replace(/^\/|\/$/g, '').split('/');
    path.pop();

    actions.changeDirectory(path.length > 0 ? '/' + path.join('/') + '/' : '/');
};

export const setFilelist = ({dispatch}, files) => {
    dispatch('SET_LOADING', false);
    dispatch('SET_FILELIST', files);
};