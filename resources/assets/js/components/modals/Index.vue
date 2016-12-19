<template>
    <div>
        <modal-delete></modal-delete>
        <modal-create></modal-create>
        <modal-upload></modal-upload>
    </div>
</template>

<script>
    import ModalDelete from './Delete.vue'
    import ModalCreate from './Create.vue'
    import ModalUpload from './Upload.vue'

    export default {
        components: {
            ModalDelete,
            ModalCreate,
            ModalUpload,
        }
    }
</script>