import React from 'react';

class FileListEntry extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            file: props.file
        };
    }

    formatFilesize(size) {
        if(typeof size === 'undefined') return '';

        var i = Math.floor( Math.log(size) / Math.log(1024) );
        return ( size / Math.pow(1024, i) ).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
    }

    render() {

        var file = this.state.file;

        var href = (file.type === 'dir') ? '#/dir/' : '#/file/';
        href += file.path;

        var imgsrc = 'assets/images/icon-' + file.type + '.png';
        return (
            <tr onClick={this.onClick}>
                <td><input type="checkbox"/></td>
                <td><img src={imgsrc} alt={file.type}/></td>
                <td><a href={href}>{file.filename}</a></td>
                <td className="text-right">A</td>
                <td className="text-right">{this.formatFilesize(file.size)}</td>
                <td className="text-right">A</td>
                <td className="text-right">X Y</td>
            </tr>
        );
    }
}

export default FileListEntry;
