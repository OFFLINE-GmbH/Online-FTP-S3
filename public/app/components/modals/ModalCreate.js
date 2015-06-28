import React from 'react'
import Modal from 'react-bootstrap/lib/Modal'
import Button from 'react-bootstrap/lib/Button'
import FormGroup from 'react-bootstrap/lib/FormGroup'
import Input from 'react-bootstrap/lib/Input'

class ModalCreate extends React.Component {

    constructor(props) {
        super(props);

        this.state = {
            type: 'file',
            name: ''
        }
    }

    _create() {

    }

    _onNameChange() {
        this.setState({
            name: event.target.value
        });
    }

    _onTypeChange() {
        this.setState({
         type: event.target.value
        });
    }

    render() {
        return (
      <Modal {...this.props} title="Erstellen" animation={true}>
        <div className="modal-body">
            <Input type="text" label="Name" placeholder="Name" value={this.state.name} onChange={this._onNameChange.bind(this)} />
            <FormGroup>
                <div className="btn-group" data-toggle="buttons">
                    <label className="btn btn-default active">
                        // @TODO: Add _onTypeChange handler
                        <input type="radio" checked={this.state.type === 'dir'} /> Verzeichnis
                    </label>
                    <label className="btn btn-default">
                        // @TODO: Add _onTypeChange handler
                        <input type="radio" checked={this.state.type === 'file'} /> Datei
                    </label>
                </div>
            </FormGroup>
            <div className="modal-footer">
              <Button onClick={this.props.onRequestHide}>Abbrechen</Button>
              <Button onClick={this._create()} bsStyle="primary">Erstellen</Button>
            </div>
        </div>
      </Modal>
    );
    }
}


export default ModalCreate;
