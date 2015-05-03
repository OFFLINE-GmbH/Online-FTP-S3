'use strict';
import React from 'react';
class FileListEntry extends React.Component {

    render() {
        var href = (this.props.type === 'dir') ? '#/dir/' : '#/file/';
        href += this.props.path;

        var imgsrc = 'assets/images/icon-' + this.props.type + '.png';
        return (
            <tr onClick={this.onClick}>
                <td><input type="checkbox"/></td>
                <td><img src={imgsrc} alt={this.props.type} /></td>
                <td><a href={href}>{this.props.filename}</a></td>
                <td className="text-right">A</td>
                <td className="text-right">{this.props.size}</td>
                <td className="text-right">A</td>
                <td className="text-right">X Y</td>
            </tr>
        )
    }
}

export default FileListEntry;