<template>
    <modal :show.sync="showModal"
           key="confirmDelete"
           :confirm="confirm"
           :cancel="cancel"
    >
        <h3 slot="header">Test</h3>
    </modal>
</template>

<script>
    import Modal from './modal.vue';

    export default {
        methods: {
            confirm() {
                console.log('confirmed');
            },
            cancel() {
                console.log('cancelled');
            }
        },
        components: {
            Modal
        }
    }
</script>