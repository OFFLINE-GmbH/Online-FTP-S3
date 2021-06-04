<template>
    <modal :confirm="confirm"
           :disabled="disabled"
           :width="400"
           identifier="confirmDelete">

        <h3 slot="header">Are you sure?</h3>
        <p slot="body">
            Do you really want to delete the selected files?
        </p>

        <template slot="btnConfirm">Yes, delete the files</template>
    </modal>
</template>

<script type="text/babel">
    import Modal from './Modal.vue';
    import * as types from '../../store/types'
    import {mapActions, mapState} from 'vuex'

    export default {
        props: ['width'],
        data() {
            return {
                disabled: false
            }
        },
        methods: {
            ...mapActions({
                deleteSelected: types.DELETE_SELECTED
            }),
            confirm() {
                this.disabled = true;
                this.deleteSelected().then(() => {
                    this.disabled = false;
                });
            }
        },
        components: {
            Modal
        }
    }
</script>