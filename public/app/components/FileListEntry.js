/* jshint esnext: true */

import React from 'react';

class FileListEntry extends React.Component {

    constructor(props) {
        super(props);

        var isChecked = props.selectedEntries.hasOwnProperty(props.file.path);

        this.state = {
            file: props.file,
            isChecked
        };
    }

    _onSelect(file) {

        this.setState({
            isChecked: event.target.checked
        });

        var remove = this.state.isChecked;

        this.props.onSelect(file, remove);

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

        var imgsrc = 'images/icon-' + file.type + '.png';
        return (
            <tr onClick={this.onClick}>
                <td><input onChange={this._onSelect.bind(this, file)} type="checkbox" checked={this.state.isChecked}/></td>
                <td><img src={imgsrc} alt={file.type}/></td>
                <td><a href={href}>{file.basename}</a></td>
                <td className="text-right">A</td>
                <td className="text-right">{this.formatFilesize(file.size)}</td>
                <td className="text-right">A</td>
                <td className="text-right">X Y</td>
            </tr>
        );
    }
}

export default FileListEntry;
