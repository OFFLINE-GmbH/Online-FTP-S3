'use strict';

import FileListEntry from './FileListEntry'

class FileList extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            files: [],
            path: this.props.path,
            isLoading: false
        };
    }

    componentDidMount() {
        this.getFiles(this.state.path);
    }

    componentWillReceiveProps(nextProps) {
        this.getFiles(nextProps.path);
    }

    getFiles(path) {
        if(typeof path === 'undefined') path = this.state.path;
        var isLoading = true;

        this.setState({isLoading});

        $.ajax({
            url: `/api/dir/${path}`,
            dataType: 'json',
            cache: false,
            success: (files) => {
                isLoading = false;
                files = files.content;
                this.setState({files, path, isLoading});
            },
            error: (xhr, status, err) => {
                console.error(this.props.url, status, err.toString());
            }
        });
    }
    render() {
        var addFile = (file) => {
            return <FileListEntry
                filename={file.filename}
                type={file.type}
                size={file.size}
                path={file.path}
                />
        }
        var classes = 'table table-filelist table--striped is-clickable';

        if(this.state.isLoading) classes += ' is-loading';

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
                { this.state.files.map(addFile) }
                </tbody>
            </table>
        )
    }
}

export default FileList;