let store = {};

store.files = [];
store.path = 'public_html/test/dir';
store.isLoading = false;

/**
 * Fetch the given list of items.
 */
store.fetchFiles = (path) => {
    store.isLoading = true;
    setTimeout(() => {
        store.files = [
            {
                type: 'file',
                name: 'filename',
                permissions: 'perms',
                size: '20 kb',
                last_modified: '24.11.1990'
            }
        ];
        store.isLoading = false;
    }, 3000);
};
/**
 * Change directory.
 *
 * @param {Array<Number>} ids
 * @return {Promise}
 */
store.cd = path => {
    store.path = path;
    store.fetchFiles(path);
};

export default store;