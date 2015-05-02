'use strict';
class FileList extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            files: [],
            path: props.path
        };
        console.log(props.path);
    }

    componentDidMount() {
        this.getFiles();
    }

    getFiles(path) {
        if(typeof path === 'undefined') path = '';

        $.ajax({
            url: `/api/dir/${path}`,
            dataType: 'json',
            cache: false,
            success: (files) => {
                files = files.content;
                this.setState({files, path});
            },
            error: (xhr, status, err) => {
                console.error(this.props.url, status, err.toString());
            }
        });
    }

    navigate(path) {
        this.setState({path});
    }

    render() {
        var addFile = (file) => {
            return <FileListEntry
                        filename={file.filename}
                        type={file.type}
                        size={file.size}
                        onNavigate={this.getFiles.bind(this)}
                />
        }
        return (
            <table className="table table-filelist table--striped is-clickable">
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
