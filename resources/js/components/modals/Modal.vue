<template>
    <div class="modal-mask" v-show="show" transition="modal">
        <div class="modal-wrapper">
            <div class="modal-container" :style="{width: width + 'px'}">

                <div class="modal-header">
                    <slot name="header"></slot>
                </div>

                <div class="modal-body">
                    <slot name="body"></slot>
                </div>

                <div class="modal-footer">
                    <slot name="footer">
                        <button type="button"
                                class="btn btn-primary"
                                :class="{disabled: disabled}"
                                @click.prevent="btnConfirm()">
                            <slot name="btnConfirm">Confirm</slot>
                        </button>
                        <button type="button"
                                class="btn btn-default"
                                @click.prevent="btnCancel()">
                            <slot name="btnCancel">Cancel</slot>
                        </button>
                    </slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import * as types from '../../store/types'
    import { mapActions, mapState } from 'vuex'
    export default {
        props: ['identifier', 'confirm', 'cancel', 'width', 'disabled'],
        methods: {
            toggleModal(identifier) {
                this.$store.commit(types.TOGGLE_MODAL, identifier)
            },
            btnConfirm() {
                if (this.confirm) this.confirm();
            },
            btnCancel() {
                this.hide();
                if (this.cancel) this.cancel();
            },
            hide() {
                this.toggleModal(this.identifier);
            }
        },
        computed: {
            ...mapState({
                show(state) {
                    return state.visibleModals[this.identifier];
                }
            })
        }
    }
</script>

<style>
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        display: table;
        transition: opacity .3s ease;
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }

    .modal-container {
        width: 300px;
        margin: 0px auto;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 2px;
        max-width: 90vw;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
        transition: all .3s ease;
        font-family: Helvetica, Arial, sans-serif;
    }

    .modal-header h3 {
        margin-top: 0;
    }

    .modal-body {
        margin: 20px 0;
    }

    .modal-enter, .modal-leave {
        opacity: 0;
    }

    .modal-enter .modal-container,
    .modal-leave .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }

    @media screen and (max-width: 990px) {
        .modal-container .btn-group {
            width: 100%;
            margin-top: 20px;
        }

        .modal-container .btn-group .btn {
            width: 50%;
        }
    }
</style>