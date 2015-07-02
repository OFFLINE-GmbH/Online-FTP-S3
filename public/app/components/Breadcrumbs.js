/* jshint esnext: true */

import React from 'react';
class Breadcrumbs extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            parts: this.parsePath(props.path)
        };
    }

    componentWillReceiveProps(nextProps) {
        this.setState({parts: this.parsePath(nextProps.path)});
    }

    parsePath(path) {

        // Remove trailing slash
        if(path.substr(-1) == '/') {
            path = path.substr(0, path.length - 1);
        }

        var parts = path.split('/');
        var breadcrumbs = [];
        var path = '/';

        parts.forEach(function (element) {
            // root element
            if (element == '') {
                element = 'ftp.server.ch';
            } else {
                path = path + element + '/';
            }
            breadcrumbs = breadcrumbs.concat({path, label: element});
        });

        return breadcrumbs;
    }

    render() {
        var addBreadcrumb = (breadcrumb) => {
            var href = `#/dir${breadcrumb.path}`;
            return <li key={breadcrumb.path}>
                <a href={href}>{breadcrumb.label}</a>
            </li>
        }
        return (
            <div>
                <ol className="breadcrumb">
                    { this.state.parts.map(addBreadcrumb) }
                </ol>
            </div>
        )
    }
}

export default Breadcrumbs;
