'use strict';
import React from 'react';
import FileTree from './FileTree'
import Breadcrumbs from './Breadcrumbs'
import Toolbar from './Toolbar'
import FileList from './FileList'
import Editor from './Editor'


class OnlineFtp extends React.Component {

    constructor(props) {
        super(props);

        this.state = {
            selectedEntries: []
        }
    }

    parseRoute(hash) {
        var parts = hash.split('/');

        var type = parts[0];
        delete parts[0];

        var path = parts.join('/');

        return {type, path}
    }

    _onSelect(file, remove = false) {

        var selectedEntries = this.state.selectedEntries;

        if(remove) {
            delete selectedEntries[file.path];
        } else {
            selectedEntries[file.path] = file;
        }

        this.setState({
            selectedEntries
        });
    }

    _onNavigate() {
        this.setState({
            selectedEntries: []
        });
    }

    render() {
        var route = this.parseRoute(this.props.hash);

        var Child;
        switch(route.type) {
            case 'file': Child = Editor; break;
            default: Child = FileList; break;
        }
        return (
            <div className="row">
                <aside className="sidebar col-md-2">
                    <FileTree />
                </aside>
                <main className="main col-md-10">
                    <header className="header">
                        <Breadcrumbs path={route.path}/>
                        <Toolbar
                            selectedEntries={this.state.selectedEntries}
                             />
                    </header>
                    <section className="content">
                        <Child
                            path={route.path}
                            onSelect={this._onSelect.bind(this)}
                            onNavigate={this._onNavigate.bind(this)}
                            selectedEntries={this.state.selectedEntries}
                            />
                    </section>
                </main>
            </div>
        );
    }
}

function render() {
    var hash = window.location.hash.substr(2);
    React.render(<OnlineFtp hash={hash}/>, document.getElementById('app'));
}

window.onhashchange = render;

$(function() {
    $.subscribe('filelist.reload', render);
});

render();


export default OnlineFtp;
