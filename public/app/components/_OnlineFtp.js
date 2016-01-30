/* jshint esnext: true */

import React from 'react';
import FileTree from './FileTree';
import Breadcrumbs from './Breadcrumbs';
import Toolbar from './Toolbar';
import FileList from './FileList';
import Editor from './Editor';


Object.size = function(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};


class OnlineFtp extends React.Component {

    constructor(props) {
        super(props);

        this.state = {
            selectedEntries: []
        };
    }

    parseRoute(hash) {
        var parts = hash.split('/');

        var type = parts[0];
        delete parts[0];

        var path = parts.join('/');

        return {type, path};
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

    _refresh() {
        this.refs.filelist.getFiles();
    }

    _delete() {

        var that = this;
        var selectedEntries = this.state.selectedEntries;
        
        if(Object.size(selectedEntries) < 1) return;

        Object.keys(selectedEntries).forEach(function(entry) {

            var url = WEBROOT + '/file/' + entry;

            $.ajax({
                method: 'DELETE',
                url,
                data: {_method: 'DELETE'}
            })
            .done(() => {
                that._refresh();
            })
            .fail((response) => {
                alert('Fehler beim Löschen der Datei ' + entry);
            });

        });

    }

    render() {
        var route = this.parseRoute(this.props.hash);

        var Child;
        switch(route.type) {
            case 'file':
            Child = (
                <Editor path={route.path} />
            );
            break;

            default:
                Child = (
                    <div>
                        <aside className="sidebar col-md-2">
                            <FileTree />
                        </aside>
                        <main className="main col-md-10">
                            <header className="header">
                                <Breadcrumbs path={route.path}/>
                                <Toolbar
                                    doDelete={this._delete.bind(this)}
                                    doRefresh={this._refresh.bind(this)}
                                     />
                            </header>
                            <section className="content">
                                <FileList
                                     ref="filelist"
                                     path={route.path}
                                     onSelect={this._onSelect.bind(this)}
                                     onNavigate={this._onNavigate.bind(this)}
                                     selectedEntries={this.state.selectedEntries} />
                            </section>
                        </main>
                    </div>
                );
            break;
        }
        return (
            <div className="row">
                {Child}
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
