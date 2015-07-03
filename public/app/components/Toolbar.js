/* jshint esnext: true */

import React from 'react';
import ButtonToolbar from 'react-bootstrap/lib/ButtonToolbar';
import ButtonGroup from 'react-bootstrap/lib/ButtonGroup';
import Button from 'react-bootstrap/lib/Button';
import Glyphicon from 'react-bootstrap/lib/Glyphicon';
import ModalTrigger from 'react-bootstrap/lib/ModalTrigger';
import ModalCreate from './modals/ModalCreate';


Object.size = function(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};

class Toolbar extends React.Component {

    onDelete() {

        var that = this;
        var selectedEntries = this.props.selectedEntries;
        if(Object.size(selectedEntries) < 1) return;

        Object.keys(selectedEntries).forEach(function(entry) {

            var url = WEBROOT + '/file/' + entry;

            $.ajax({
                method: 'DELETE',
                url,
                data: {_method: 'DELETE'}
            })
            .done(() => {
                that.props.doRefresh();
            })
            .fail((response) => {
                console.error(response);
                alert('Fehler beim Löschen der Datei ' + entry);
            });

        });

    }

    render() {
        return (
            <ButtonToolbar>
                    <ButtonGroup>
                        <Button bsStyle="primary">
                            <Glyphicon glyph="arrow-up" />&nbsp;
                            Upload
                        </Button>
                        <Button bsStyle="primary">
                            <Glyphicon glyph="arrow-down" />&nbsp;
                            Download
                        </Button>
                    </ButtonGroup>
                    <ButtonGroup>
                        <Button>Verschieben</Button>
                        <Button onClick={this.onDelete.bind(this)}>Löschen</Button>
                    </ButtonGroup>
                    <ButtonGroup>
                        <ModalTrigger modal={<ModalCreate />}>
                             <Button>Erstellen</Button>
                         </ModalTrigger>
                    </ButtonGroup>
                    <ButtonGroup>
                        <Button><Glyphicon glyph="refresh" /></Button>
                    </ButtonGroup>
            </ButtonToolbar>
        )
    }
}

/**
<div className="toolbar btn-toolbar">
    <div className="btn-group">
        <button className="btn-toolbar-upload btn btn-primary">
            <span className="glyphicon glyphicon-arrow-up"></span>&nbsp;
            Upload
        </button>
        <button className="btn-toolbar-download btn btn-primary">
            <span className="glyphicon glyphicon-arrow-down"></span>&nbsp;
            Download
        </button>
    </div>
    <div className="btn-group">
        <button className="btn-toolbar-move btn btn-default">Verschieben</button>
        <button className="btn-toolbar-delete btn btn-default">Löschen</button>
    </div>
    <div className="btn-group">
        <button className="btn-toolbar-create btn btn-default">Erstellen</button>
    </div>
    <div className="btn-group">
        <button className="btn-toolbar-refresh btn btn-default">
            <span className="glyphicon glyphicon-refresh" aria-hidden="true"></span>
        </button>
    </div>
</div>
*/

export default Toolbar;
