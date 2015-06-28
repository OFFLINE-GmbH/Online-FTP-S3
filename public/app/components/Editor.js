import React from 'react';
import AceEditor from 'react-ace';


require('brace/mode/php')
require('brace/theme/github')

class Editor extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            contents: '',
            path: this.props.path,
            isLoading: true
        };
    }

    componentDidMount() {
        this.getContents(this.state.path);
        this.onLoad();
    }

    componentWillReceiveProps(nextProps) {
        this.getContents(nextProps.path);
    }

    getContents(path) {
        if (typeof path === 'undefined') path = this.state.path;

        this.setState({isLoading: true});

        $.ajax({
            url: `/api/file${path}`,
            dataType: 'json',
            cache: false,
            success: (files) => {
                this.setState({contents: files.content, path, isLoading: false});
            },
            error: (xhr, status, err) => {
                console.error(this.props.url, status, err.toString());
            }
        });
    }

    componentDidUpdate() {
        this.onLoad();
    }

    onLoad() {
        // setTimeout(() => {
        // var editor = ace.edit('editor');
        // editor.setTheme("ace/theme/chrome");
        // editor.getSession().setMode('/ace/mode/javascript');
        // }, 2000);
    }

    render() {
        var classes = '';
        if (!this.state.isLoading) classes += ' is-visible';

        return (
            <AceEditor
                mode="php"
                theme="github"
                name="editor"
                width="100%"
                height="100%"
                value={this.state.contents}
                />
        )
    }
}

export default Editor;
