<template>
    <modal :confirm="confirm"
           :disabled="disabled"
           identifier="create"
           width="500"
    >
        <h3 slot="header">Create a new file or folder</h3>
        <div slot="body">
            <p>What do you want to create?</p>

            <div class="row">
                <div class="col-md-8">
                    <input class="form-control" ref="input" placeholder="Filename" type="text" v-model="name" autofocus>
                </div>
                <div class="col-md-4">
                    <div class="btn-group" data-toggle="buttons">
                        <label @click="type = 'file'"
                               class="btn btn-default btn-small"
                               :class="{active: type === 'file'}">
                            <input value="file" type="radio" autocomplete="off">
                            File
                        </label>
                        <label @click="type = 'directory'"
                               class="btn btn-default btn-small"
                               :class="{active: type === 'directory'}">
                            <input value="directory" type="radio" autocomplete="off">
                            Folder
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <template slot="btnConfirm">Create</template>
    </modal>
</template>

<script type="text/babel">
    import Modal from './Modal.vue';
    import * as types from '../../store/types'
    import {mapActions, mapState} from 'vuex'

    export default {
        data() {
            return {
                type: 'file',
                name: '',
                disabled: false
            }
        },
        methods: {
            ...mapActions({
                create: types.CREATE_NEW
            }),
            confirm() {
                if (this.name === '') {
                    return this.$refs.input.focus();
                }
                this.disabled = true;
                this.create({type: this.type, path: this.name}).then(this.reset);
            },
            reset() {
                this.type = 'file';
                this.name = '';
                this.disabled = false;
            }
        },
        components: {
            Modal
        }
    }
</script>