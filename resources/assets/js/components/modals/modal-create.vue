<template>
    <modal :confirm="confirm"
           :disabled="disabled"
           key="create"
           width="500"
    >
        <h3 slot="header">Create a new file or folder</h3>
        <div slot="body">
            <p>What do you want to create?</p>

            <div class="row">
                <div class="col-md-8">
                    <input class="form-control" v-el:input placeholder="Name" type="text" v-model="name" autofocus>
                </div>
                <div class="col-md-4">
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default btn-small" :class="{active: type === 'file'}">
                            <input v-model="type" value="file" type="radio" autocomplete="off">
                            File
                        </label>
                        <label class="btn btn-default btn-small" :class="{active: type === 'folder'}">
                            <input v-model="type" value="folder" type="radio" autocomplete="off">
                            Folder
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <template slot="btnConfirm">Create</template>
    </modal>
</template>

<script>
    import Modal from './modal.vue';
    import store from '../../store';

    export default {
        data() {
            return {
                type: 'file',
                name: '',
                disabled: false
            }
        },
        methods: {
            confirm() {
                if(this.name === '') {
                    return this.$els.input.focus();
                }
                this.disabled = true;
                store.actions.create(this.type, this.name, () => {
                    this.reset();
                });
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