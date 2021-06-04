<template>
    <modal :confirm="confirm"
           :disabled="disabled"
           identifier="upload"
           width="500"
    >
        <h3 slot="header">Upload a new file</h3>
        <div slot="body">
            <p>Select the files you want to upload</p>

            <input ref="file" type="file" multiple>

            <div class="checkbox zip-checkbox">
                <label>
                    <input v-model="extract" type="checkbox"> Extract ZIP archives on server
                </label>
            </div>
        </div>

        <template slot="btnConfirm">Upload files</template>
    </modal>
</template>

<script type="text/babel">
    import Modal from './Modal.vue';
    import * as types from '../../store/types'
    import { mapActions, mapState } from 'vuex'

    export default {
        data() {
            return {
                extract: false
            }
        },
        methods: {
            ...mapActions({
               upload: types.UPLOAD
            }),
            confirm() {
                let files = this.$refs.file.files;

                if (files.length < 1) return false;

                this.disabled = true;
                this.upload({files, extract: this.extract}).then(() => {
                    this.disabled = false;
                    this.extract = false;
                    this.$refs.file.value = '';
                });
            }
        },
        components: {
            Modal
        }
    }
</script>

<style>
    .zip-checkbox {
        margin-top: 3em;
    }
</style>