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