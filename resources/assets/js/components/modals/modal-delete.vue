<template>
    <modal :show.sync="showModal"
           :confirm="confirm"
           key="confirmDelete"
    >
        <h3 slot="header">Test</h3>
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