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
    http({url: '/directory/?path=' + removeSlashes(path), method: 'GET'}).then((response) => {
        response.data.listing.map((item) => {
            item.checked = false;
            item._uid = +Date.now();

            return item;
        });

        cb(response.data.listing);
    }, (response) => {
        console.error('Cannot fetch files for', path, response);
    });
}

export function getContents(path, cb) {
    http({url: '/file/?path=' + removeSlashes(path), method: 'GET'}).then((response) => {
        cb(response.data.contents, path);
    }, (response) => {
        console.error('Cannot fetch contents for', path, response);
    });
}

export function putContents(path, contents, cb) {
    http({url: '/file/?path=' + removeSlashes(path), method: 'PUT', data: {contents}}).then((response) => {
        cb(response.data, path, contents);
    }, (response) => {
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

export function create(type, name, cb) {
    console.log('creating', type, name);
    setTimeout(() => {
        cb(type, name)
    }, LATENCY)
}

export function download(files, cb) {
    console.log('downloading', files);
    setTimeout(() => {
        cb(files)
    }, LATENCY)
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