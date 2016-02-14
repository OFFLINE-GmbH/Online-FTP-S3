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

export const deleteSelected = ({dispatch, actions, state}, cb) => {
    let files = state.files.filter((file) => file.checked);

    let cleanUp = () => {
        actions.toggleModal('confirmDelete');
        if(cb) {
            cb();
        }
    };

    if (files.length < 1) {
        cleanUp();
        return false;
    }

    dispatch('SET_LOADING', true);

    api.deleteFiles(files, () => {
        cleanUp();
        actions.refresh();
    });
};

export const downloadSelected = ({dispatch, actions, state}, cb) => {

    let files = state.files.filter((file) => file.checked);

    let cleanUp = () => {
        if(cb) {
            cb();
        }
        dispatch('SET_LOADING', false);
    };

    if (files.length < 1) {
        cleanUp();
        return false;
    }

    dispatch('SET_LOADING', true);

    api.download(files, (files) => {
        actions.toggleAll(false);
        cleanUp();
    });
};

export const create = ({dispatch, actions, state}, type, name, cb) => {
    dispatch('SET_LOADING', true);

    api.create(type, name, (type, name) => {
        actions.toggleModal('create');
        actions.refresh();
        if (cb) {
            cb();
        }
    });
};

export const toggleFile = ({dispatch}, file, forceState) => {
    dispatch('TOGGLE_FILE', file, forceState);
};

export const toggleAll = ({dispatch, state, actions}, forceState) => {
    dispatch('SET_ALL_SELECTED', forceState);
    state.files.forEach((file) => {
        actions.toggleFile(file, forceState);
    });
};

export const changeDirectoryRelative = ({state, actions}, path) => {
    path = state.path += path + '/';
    actions.changeDirectory(path);
};

export const changeDirectory = ({actions}, path) => {
    actions.fetchFiles(path);
};

export const refresh = ({actions, state}) => {
    actions.fetchFiles(state.path);
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
    dispatch('SET_ALL_SELECTED', false);
    dispatch('SET_FILELIST', files);
};