<template>
    <modal :show.sync="showModal"
           :confirm="confirm"
           key="confirmDelete"
    >
        <h3 slot="header">Are you sure?</h3>
        <p slot="body">Do you really want to delete the selected files?</p>

        <template slot="btnConfirm">Yes, delete the files</template>
    </modal>
</template>

<script>
    import Modal from './modal.vue';
    import store from '../../store';

    export default {
        methods: {
            confirm() {
                store.actions.deleteSelected();
            }
        },
        components: {
            Modal
        }
    }
</script>