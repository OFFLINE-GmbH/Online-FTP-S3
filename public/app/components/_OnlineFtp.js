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
    }

    parseRoute(hash) {
        var parts = hash.split('/');

        var type = parts[0];
        delete parts[0];

        var path = parts.join('/');

        return {type, path}
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
                        <Breadcrumbs path={route.path} />
                        <Toolbar />
                    </header>
                    <section className="content">
                        <Child path={route.path}/>
                    </section>
                </main>
            </div>
        )
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
