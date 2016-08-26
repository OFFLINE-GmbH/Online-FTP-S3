import Vue from "vue";
Vue.use(require('vue-resource'));

// let data = require('./mock-data');
const LATENCY = 200;
//
// setTimeout(() => {
//     cb(data, path)
// }, LATENCY);

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
        console.error('Cannot fetch files for', path, response);
    });
}

export function getContents(path, cb) {
    http({url: '/file/?path=' + removeSlashes(path), method: 'GET'}).then(response => {
        cb(response.data.contents, path);
    }, response => {
        console.error('Cannot fetch contents for', path, response);
    });
}

export function putContents(path, contents, cb) {
    path = removeSlashes(path);
    http({url: '/file', method: 'PUT', data: {path, contents}}).then(response => {
        cb(response.data, path, contents);
    }, response => {
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
        responses => cb(responses, files),
        response => console.error('Cannot delete files', files, response)
    );
}

export function create(type, path, cb) {
    http({url: `/${type}`, method: 'POST', data: {path}}).then(response => {
        cb(response, type, path);
    });
}

export function download(path, cb, failed) {
    console.log('downloading', path);
    http({url: `/download`, method: 'POST', data: {path}}).then(response => {
        cb(response.data);
    }, response => {
        console.error('Cannot download', path, response);
        failed();
    });
}

export function upload(files, cb) {
    console.log('uploading', files);

    // var data = new FormData();
    // for single file
    // data.append('files', files[0]);
    // Or for multiple files you can also do
    //  _.each(files, function(v, k){
    //    data.append('avatars['+k+']', v);
    // });

    //this.$http.post('/avatars/upload', data, function (data, status, request) {
    //    //handling
    //}).error(function (data, status, request) {
    //    //handling
    //});

    setTimeout(() => {
        cb(files)
    }, LATENCY)
}