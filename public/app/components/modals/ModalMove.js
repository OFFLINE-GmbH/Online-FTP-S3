import React from 'react'
import FileTree from '../FileTree'
import Modal from 'react-bootstrap/lib/Modal'
import Button from 'react-bootstrap/lib/Button'
import ButtonGroup from 'react-bootstrap/lib/ButtonGroup'
import FormGroup from 'react-bootstrap/lib/FormGroup'
import Input from 'react-bootstrap/lib/Input'

class ModalCreate extends React.Component {

    constructor(props) {
        super(props);

        this.state = {
            target: '',
            isDirty: false
        };
    }

    componentDidMount() {
        // wait for animation to be over
        setTimeout(() => this.refs.target.getInputDOMNode().focus(), 300);
    }

    _move() {
        if(this.state.target === '') {
            this.refs.target.getInputDOMNode().focus();
            return;
        }

        var url = WEBROOT + '/' + this.state.type;
        var data = {
            'name' : this.state.target
        };

        $.ajax({
            method: 'POST',
            data,
            url
        })
        .done(() => {
            $.publish('filelist.reload');
            this.props.onRequestHide();
        })
        .fail((response) => {
            console.error(response);
            alert('Fehler beim Verschieben!');
        });

    }

    render() {

        return (
          <Modal {...this.props} title="Erstellen" animation={true}>
            <div className="modal-body">
                <FileTree></FileTree>
                <div className="modal-footer">
                  <Button onClick={this.props.onRequestHide}>Abbrechen</Button>
                  <Button onClick={this._move.bind(this)} bsStyle="primary">Verschieben</Button>
                </div>
            </div>
          </Modal>
        );
    }
}


export default ModalCreate;
