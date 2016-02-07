import * as api from '../api'

export const setLoading = ({dispatch}, isLoading) => {
    dispatch('SET_LOADING', isLoading)
};

export const setPath = ({dispatch}, path) => {
    dispatch('SET_PATH', path)
};

export const fetchFiles = (store, path) => {
    store.dispatch('SET_LOADING', true);
    store.actions.setPath(path);
    api.getFiles(path, (files) => {
        store.actions.setFilelist(files);
    });
};

export const changeDirectory = (store, path) => {
    store.dispatch('SET_PATH', path);
    store.actions.fetchFiles(store, path);
};

export const setFilelist = ({dispatch}, files) => {
    console.log('dispaltch', false);
    dispatch('SET_LOADING', false);
    dispatch('SET_FILELIST', files);
};
