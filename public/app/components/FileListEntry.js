'use strict';
class FileListEntry extends React.Component {

    navigate(e) {
        e.preventDefault();

        this.props.onNavigate(this.props.filename);
    }

    render() {
        var route = `#/dir/${this.props.filename}`
        return (
            <tr>
                <td><input type="checkbox"/></td>
                <td>{this.props.type}</td>
                <td><a href={route}>{this.props.filename}</a></td>
                <td className="text-right">A</td>
                <td className="text-right">{this.props.size}</td>
                <td className="text-right">A</td>
                <td className="text-right">X Y</td>
            </tr>
        )
    }
}
