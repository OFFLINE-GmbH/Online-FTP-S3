<template>
    <tr>
        <td>
            <input type="checkbox"
                   :checked="item.checked"
                   v-model="checked"
                   @change.prevent="toggle(item)"
            >
        </td>
        <td>
            <span class="glyphicon glyphicon-{{ this.icon }}"></span>
        </td>
        <td>
            <a @click.prevent="click">
                {{ item.basename }}
            </a>
        </td>
        <td>{{ item.visibility }}</td>
        <td>{{ item.size }}</td>
        <td>{{ item.last_modified }}</td>
    </tr>
</template>

<script>
    import store from '../store';

    export default {
        props: ['item'],
        methods: {
            toggle(item) {
                store.actions.toggleFile(item);
            },
            click() {
                if(this.item.type === 'file') {
                    store.actions.fetchContents(this.item.basename);
                } else {
                    store.actions.changeDirectoryRelative(this.item.basename)
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