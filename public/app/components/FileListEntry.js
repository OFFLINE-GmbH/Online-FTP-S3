'use strict';

class FileListEntry extends React.Component {

    render() {
        var href = (this.props.type === 'dir') ? '#/dir/' : '#/file/';
        href += this.props.path;

        return (
            <tr>
                <td><input type="checkbox"/></td>
                <td>{this.props.type}</td>
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