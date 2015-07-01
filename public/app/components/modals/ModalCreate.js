import React from 'react'
import Modal from 'react-bootstrap/lib/Modal'
import Button from 'react-bootstrap/lib/Button'
import ButtonGroup from 'react-bootstrap/lib/ButtonGroup'
import FormGroup from 'react-bootstrap/lib/FormGroup'
import Input from 'react-bootstrap/lib/Input'

class ModalCreate extends React.Component {

    constructor(props) {
        super(props);

        this.state = {
            type: 'file',
            name: '',
            isDirty: false
        };
    }

    componentDidMount() {
        // wait for animation to be over
        setTimeout(() => this.refs.name.getInputDOMNode().focus(), 300);
    }

    _create() {
        if(this.state.name === '') {
            this.refs.name.getInputDOMNode().focus();
            return;
        }

        var url = WEBROOT + '/' + this.state.type;
        var data = {
            'name' : this.state.name,
            'content': ''
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
            alert('Fehler beim Erstellen!');
        });

    }

    _onNameChange() {
        this.setState({
            name: event.target.value,
            isDirty: true
        });
    }

    _onTypeChange(type) {
        this.setState({
            type
        });
    }

    _validationState() {

        if(this.state.isDirty && this.state.name.length < 1) {
            return 'error';
        }

        return;
    }

    render() {

        var dirActiveClass  = this.state.type === 'dir'  ? 'active' : '';
        var fileActiveClass = this.state.type === 'file' ? 'active' : '';

        return (
          <Modal {...this.props} title="Erstellen" animation={true}>
            <div className="modal-body">
                <Input ref="name" autoFocus={true} bsStyle={this._validationState()} type="text" label="Name" placeholder="Name" value={this.state.name} onChange={this._onNameChange.bind(this)} />
                <FormGroup>
                    <ButtonGroup>
                        <Button onClick={this._onTypeChange.bind(this, 'dir')} active={this.state.type === 'dir'}>Verzeichnis</Button>
                        <Button onClick={this._onTypeChange.bind(this, 'file')} active={this.state.type === 'file'}>Datei</Button>
                    </ButtonGroup>
                </FormGroup>
                <div className="modal-footer">
                  <Button onClick={this.props.onRequestHide}>Abbrechen</Button>
                  <Button onClick={this._create.bind(this)} bsStyle="primary">Erstellen</Button>
                </div>
            </div>
          </Modal>
        );
    }
}


export default ModalCreate;
