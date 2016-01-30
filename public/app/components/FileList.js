/* jshint esnext: true */

import React from 'react';
import FileListEntry from './FileListEntry';

class FileList extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            files: [],
            path: this.props.path,
            isLoading: true
        };
    }

    componentDidMount() {
        this.getFiles(this.state.path);
    }

    componentWillReceiveProps(nextProps) {
        if(nextProps.path !== this.state.path) {
            this.getFiles(nextProps.path);
        }
    }

    getFiles(path) {
        if (typeof path === 'undefined') path = this.state.path;

        this.setState({isLoading: true});

        $.ajax({
            url: `/api/dir/${path}`,
            dataType: 'json',
            cache: false,
            success: (response) => {
                this.props.onNavigate();
                this.setState({files: response.content, path, isLoading: false});
            },
            error: (xhr, status, err) => {
                console.error(this.props.url, status, err.toString());
            }
        });
    }

    render() {
        var addFile = (file) => {
            return <FileListEntry
                key={"file-" + file.basename + +Date.now()}
                file={file}
                onSelect={this.props.onSelect}
                selectedEntries={this.props.selectedEntries}
                 />
        }
        var classes = 'table table-filelist table-striped is-clickable';

        if (this.state.isLoading) classes += ' is-loading';

        if (this.state.files.length > 0) {
            var fileListing = this.state.files.map(addFile);
        } else {
            var fileListing = <tr>
                <td colSpan="2">&nbsp;</td>
                <td colSpan="5">Dieser Ordner ist leer</td>
            </tr>;
        }

        return (
            <table className={classes}>
                <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>Dateiname</th>
                    <th className="text-right">Berechtigung</th>
                    <th className="text-right">Dateigrösse</th>
                    <th className="text-right">Datum</th>
                    <th className="text-right">Aktionen</th>
                </tr>
                </thead>
                <tbody>
                { fileListing }
                </tbody>
            </table>
        )
    }
}

export default FileList;
