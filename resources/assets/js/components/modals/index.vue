<template>
    <modal-delete></modal-delete>
    <modal-create></modal-create>
    <modal-upload></modal-upload>
</template>

<script>
    import ModalDelete from './modal-delete.vue'
    import ModalCreate from './modal-create.vue'
    import ModalUpload from './modal-upload.vue'

    export default {
        components: {
            ModalDelete,
            ModalCreate,
            ModalUpload,
        }
    }
</script>