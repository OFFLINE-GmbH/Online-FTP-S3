/* jshint esnext: true */

import React from 'react';
import Glyphicon from 'react-bootstrap/lib/Glyphicon';

class FileListEntry extends React.Component {

    constructor(props) {
        super(props);

        var isChecked = props.selectedEntries.hasOwnProperty(props.file.path);

        this.state = {
            file: props.file,
            isChecked,
            isHovered: false
        };
    }

    _onSelect(file) {

        this.setState({
            isChecked: event.target.checked
        });

        var remove = this.state.isChecked;

        this.props.onSelect(file, remove);

    }

    _formatFilesize(size) {
        if(typeof size === 'undefined') return '';

        if(size === 0) return '0 B';

        var i = Math.floor( Math.log(size) / Math.log(1024) );
        return ( size / Math.pow(1024, i) ).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
    }

    _toggleMouseState(state) {
        this.setState({
            isHovered: state
        });
    }

    render() {

        var file = this.state.file;

        var renameButton = this.state.isHovered ? <Glyphicon glyph="pencil" /> : '';

        var href = (file.type === 'dir') ? '#/dir/' : '#/file/';
        href += file.path;

        var imgsrc = 'images/icon-' + file.type + '.png';
        return (
            <tr onClick={this.onClick} onMouseOver={this._toggleMouseState.bind(this, true)} onMouseLeave={this._toggleMouseState.bind(this, false)}>
                <td><input onChange={this._onSelect.bind(this, file)} type="checkbox" checked={this.state.isChecked}/></td>
                <td><img src={imgsrc} alt={file.type}/></td>
                <td><a href={href}>{file.basename}</a> {renameButton}</td>
                <td className="text-right">A</td>
                <td className="text-right">{this._formatFilesize(file.size)}</td>
                <td className="text-right">A</td>
                <td className="text-right">X Y</td>
            </tr>
        );
    }
}

export default FileListEntry;
