let data = require('./mock-data');
const LATENCY = 200;

export function getFiles(path, cb) {

    data.map((item) => {
        item.checked = false;
        item._uid = +Date.now();

        return item;
    });

    setTimeout(() => {
        cb(data)
    }, LATENCY)
}

export function deleteFiles(files, cb) {
    console.log('deleting', files);
    setTimeout((files) => {
        cb(files)
    }, LATENCY)
}

export function create(type, name, cb) {
    console.log('creating', type, name);
    setTimeout((type, name) => {
        cb(type, name)
    }, LATENCY)
}