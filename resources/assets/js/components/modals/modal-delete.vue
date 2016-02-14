<template>
    <modal :confirm="confirm"
           :disabled="disabled"
           key="confirmDelete"
    >
        <h3 slot="header">Are you sure?</h3>
        <p slot="body">Do you really want to delete the selected files?</p>

        <template slot="btnConfirm">Yes, delete the files</template>
    </modal>
</template>

<script type="text/babel">
    import Modal from './modal.vue';
    import store from '../../store';

    export default {
        data() {
            return {
                disabled: false
            }
        },
        methods: {
            confirm() {
                this.disabled = true;
                store.actions.deleteSelected(() => {this.disabled = false});
            }
        },
        components: {
            Modal
        }
    }
</script>