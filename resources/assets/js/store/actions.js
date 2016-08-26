import * as api from "../api";

const withPwd = (state, path) => {
    return state.path.replace(/^\/|\/$/g, '') + '/' + path;
};

export const setLoading = ({dispatch}, isLoading) => {
    dispatch('SET_LOADING', isLoading)
};

export const setPath = ({dispatch}, path) => {
    dispatch('SET_PATH', path)
};

export const fetchFiles = ({dispatch, actions}, path) => {
    actions.setLoading(true);
    actions.setPath(path);
    api.getFiles(path, (files) => {
        actions.setFilelist(files);
    });
};

export const fetchContents = ({dispatch, actions, state}, path) => {

    actions.setLoading(true);

    path = withPwd(state, path);

    api.getContents(path, (contents, path) => {
        dispatch('SET_OPEN_FILE', path);
        actions.setEditorContents(contents);
        actions.setLoading(false);
    });
};

export const putContents = ({dispatch, actions, state}, contents) => {
    actions.setLoading(true);

    api.putContents(state.openFile, contents, (path, contents) => {
        actions.setLoading(false);
    });
};

export const setEditorContents = ({dispatch}, contents) => {
    dispatch('SET_EDITOR_CONTENTS', contents);
};

export const deleteSelected = ({dispatch, actions, state}, cb) => {

    let files = state.files.filter(file => file.checked);

    let cleanUp = () => {
        actions.toggleModal('confirmDelete');
        actions.setLoading(false);
        if (cb) cb();
    };

    if (files.length < 1) {
        cleanUp();
        return false;
    }

    actions.setLoading(true);

    api.deleteFiles(files, () => {
        cleanUp();
        actions.refresh();
    });
};

export const downloadSelected = ({dispatch, actions, state}, cb) => {
    let files = state.files.filter(file => file.checked);

    let cleanUp = () => {
        if (cb) cb();
        actions.setLoading(false);
    };

    if (files.length < 1) {
        cleanUp();
        return false;
    }

    actions.setLoading(true);

    api.download(files, zip => {
        actions.toggleAll(false);
        cleanUp();
        document.getElementById('download-frame').setAttribute('src', '/download/' + zip);
    }, error => {
        cleanUp();
    });
};

export const downloadOpen = ({dispatch, actions, state}, cb) => {
    if (state.openFile === null) return;

    actions.setLoading(true);

    api.download([{path: state.openFile}], zip => {
        actions.setLoading(false);
        document.getElementById('download-frame').setAttribute('src', '/download/' + zip);
        if (cb) cb();
    });
};

export const create = ({dispatch, actions, state}, type, path, cb) => {
    actions.setLoading(true);

    path = withPwd(state, path);

    api.create(type, path, () => {
        actions.toggleModal('create');
        actions.refresh();
        if (cb) cb();
    });
};

export const upload = ({actions, state}, file, cb) => {
    actions.setLoading(true);

    api.upload(file, state.path, file => {
        actions.toggleModal('upload');
        actions.refresh();
        if (cb) cb();
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

export const setFilelist = ({actions, dispatch}, files) => {
    actions.setLoading(false);
    dispatch('SET_ALL_SELECTED', false);
    dispatch('SET_FILELIST', files);
};