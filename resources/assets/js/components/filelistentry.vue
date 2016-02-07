<template>
    <tr>
        <td><input type="checkbox"></td>
        <td>
            <span class="glyphicon glyphicon-{{ this.icon }}"></span>
        </td>
        <td>{{ item.name }}</td>
        <td>{{ item.permissions }}</td>
        <td>{{ item.filesize }}</td>
        <td>{{ item.last_modified }}</td>
    </tr>
</template>

<script>
    export default {
        props: ['item'],
        computed: {
            icon() {
                return this.item.type === 'file' ? 'file' : 'folder-open'
            }
        }
    }
</script>