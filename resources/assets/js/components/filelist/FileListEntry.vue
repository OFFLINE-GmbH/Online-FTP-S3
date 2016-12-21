<template>
    <tr>
        <td>
            <input type="checkbox"
                   :checked="item.checked"
                   v-model="checked"
                   @change.prevent="toggleFile(item)"
            >
        </td>
        <td>
            <span :class="`glyphicon glyphicon-` + this.icon"></span>
        </td>
        <td>
            <a @click.prevent="click">
                {{ item.basename }}
            </a>
        </td>
        <td class="hide-mobile">{{ item.visibility }}</td>
        <td class="hide-mobile text-right">{{ item.size }}</td>
    </tr>
</template>

<script>
    import * as types from '../../store/types'
    import {mapActions, mapState} from 'vuex'

    export default {
        props: ['item'],
        methods: {
            ...mapActions({
                fetchContents: types.FETCH_CONTENTS,
                changeDirectoryRelative: types.CHANGE_DIRECTORY_RELATIVE
            }),
            toggleFile(file) {
                this.$store.commit(types.TOGGLE_FILE, {file})
            },
            click() {
                if(this.item.type === 'file') {
                    this.fetchContents(this.item.basename);
                } else {
                    this.changeDirectoryRelative(this.item.basename)
                }
            }
        },
        computed: {
            icon() {
                return this.item.type === 'file'
                        ? 'file'
                        : 'folder-open'
            },
            checked() {
                return this.item.checked;
            }
        }
    }
</script>