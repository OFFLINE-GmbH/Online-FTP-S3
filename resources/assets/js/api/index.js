import Vue from 'vue';
const resource = require('vue-resource');
Vue.use(resource);

let http = Vue.http;

const removeSlashes = (str) => str.replace(/^\/|\/$/g, '');

export function getFiles (path, cb) {
    return http({url: '/directory/?path=' + removeSlashes(path), method: 'GET'}).then(response => {
        response.data.listing.map(item => {
            item.checked = false;
            item._uid = +Date.now();

            return item;
        });

        return response.data.listing;
    });
}

export function getContents (path, cb) {
    return http({url: '/file/?path=' + removeSlashes(path), method: 'GET'})
        .then(response => response.data);
}

export function putContents (path, contents) {
    path = removeSlashes(path);
    return http({url: '/file', method: 'PUT', body: {path, contents}})
        .then(response => response.data);
}

export function deleteFiles (entries, cb) {
    const files = entries.filter(entry => entry.type === 'file').map(entry => entry.path);
    const directories = entries.filter(entry => entry.type === 'dir').map(entry => entry.path);

    return Promise.all([
        http({url: '/file', method: 'DELETE', body: {path: files}}),
        http({url: '/directory', method: 'DELETE', body: {path: directories}})
    ])
}

export function create (type, path, cb) {
    return http({url: `/${type}`, method: 'POST', body: {path}})
}

export function download (path) {
    return http({url: `/download`, method: 'POST', body: {path}}).then(response => response.data);
}

export function upload (files, path, extract) {
    let data = new FormData();
    for (let i = 0; i < files.length; i++) {
        data.append('files[]', files[i]);
    }

    data.append('path', path);
    data.append('extract', extract ? 1 : 0);

    return http({url: '/upload', method: 'POST', body: data});
}