const data = require('./mock-data');
const LATENCY = 2000;

export function getFiles(path, cb) {
    setTimeout(() => {
        cb(data)
    }, LATENCY)
}