'use strict';
import React from 'react';
class Toolbar extends React.Component {
    render() {
        return (
            <div className="toolbar">
                <div className="toolbar-group">
                    <button className="btn-toolbar-upload primary">Upload</button>
                    <button className="btn-toolbar-download secondary">Download</button>
                </div>
                <div className="toolbar-group">
                    <button className="btn-toolbar-move">Verschieben</button>
                    <button className="btn-toolbar-delete">Löschen</button>
                </div>
                <div className="toolbar-group">
                    <button className="btn-toolbar-create">Erstellen</button>
                </div>
                <div className="toolbar-group">
                    <button className="btn-toolbar-refresh">Neu laden</button>
                </div>
            </div>
        )
    }
}

export default Toolbar;