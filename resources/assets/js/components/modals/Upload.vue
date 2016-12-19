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
        </div>

        <template slot="btnConfirm">Upload files</template>
    </modal>
</template>

<script type="text/babel">
    import Modal from './Modal.vue';
    import * as types from '../../store/types'
    import { mapActions, mapState } from 'vuex'

    export default {
        methods: {
            ...mapActions({
               upload: types.UPLOAD
            }),
            confirm() {
                let files = this.$refs.file.files;

                if (files.length < 1) return false;

                this.disabled = true;
                this.upload(files).then(() => {
                    this.disabled = false;
                    this.$refs.file.value = '';
                });
            }
        },
        components: {
            Modal
        }
    }
</script>