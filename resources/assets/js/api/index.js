import Vue from "vue";
var alertify = require('alertify.js');

Vue.use(require('vue-resource'));

let http = Vue.http;

const removeSlashes = (str) => str.replace(/^\/|\/$/g, '');

export function getFiles(path, cb) {
    http({url: '/directory/?path=' + removeSlashes(path), method: 'GET'}).then(response => {
        response.data.listing.map(item => {
            item.checked = false;
            item._uid = +Date.now();

            return item;
        });

        cb(response.data.listing);
    }, response => {
        alertify.error('Failed to fetch files');
        console.error('Cannot fetch files for', path, response);
    });
}

export function getContents(path, cb) {
    http({url: '/file/?path=' + removeSlashes(path), method: 'GET'}).then(response => {
        cb(response.data.contents, path);
    }, response => {
        alertify.error('Failed to fetch file');
        console.error('Cannot fetch contents for', path, response);
    });
}

export function putContents(path, contents, cb) {
    path = removeSlashes(path);
    http({url: '/file', method: 'PUT', data: {path, contents}}).then(response => {
        cb(response.data, path, contents);
        alertify.success('Successfully updated file');
    }, response => {
        alertify.error('Failed to update file');
        console.error('Cannot put contents for', path, response);
    });
}

export function deleteFiles(entries, cb) {
    const files = entries.filter(entry => entry.type === 'file').map(entry => entry.path);
    const directories = entries.filter(entry => entry.type === 'dir').map(entry => entry.path);

    Promise.all([
        http({url: '/file', method: 'DELETE', data: {path: files}}),
        http({url: '/directory', method: 'DELETE', data: {path: directories}})
    ]).then(
        responses => {
            cb(responses, files);
            alertify.success('Files deleted');
        },
        response => {
            console.error('Cannot delete files', files, response);
            alertify.error('Failed to delete files');
        }
    );
}

export function create(type, path, cb) {
    http({url: `/${type}`, method: 'POST', data: {path}}).then(response => {
        cb(response, type, path);
        alertify.success('File created');
    });
}

export function download(path, cb, failed) {
    http({url: `/download`, method: 'POST', data: {path}}).then(response => {
        cb(response.data);
        alertify.success('Download started successfully');
    }, response => {
        console.error('Cannot download', path, response);
        alertify.error('Failed to download files');
        failed();
    });
}

export function upload(files, path, cb) {
    var data = new FormData();
    for (let i = 0; i < files.length; i++) {
        data.append('files[]', files[i]);
    }

    data.append('path', path);

    http({url: '/upload', method: 'POST', data}).then(response => {
        cb(files);
        alertify.success('Upload successful');
    }, response => {
        alertify.error('Failed to upload files');
    });
}