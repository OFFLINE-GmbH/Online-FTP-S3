<template>
    <modal :confirm="confirm"
           :disabled="disabled"
           key="upload"
           width="500"
    >
        <h3 slot="header">Upload a new file</h3>
        <div slot="body">
            <p>Select the files you want to upload</p>

            <input v-el:file type="file" multiple>
        </div>

        <template slot="btnConfirm">Upload files</template>
    </modal>
</template>

<script type="text/babel">
    import Modal from './modal.vue';
    import store from '../../store';

    export default {
        methods: {
            confirm() {
                let files = this.$els.file.files;

                if (files.length < 1) {
                    return false;
                }

                this.disabled = true;
                store.actions.upload(files, () => {
                    this.disabled = false;
                });
            }
        },
        components: {
            Modal
        }
    }
</script>