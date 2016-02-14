<template>
    <div class="row">
        <div class="breadcrumbs col-md-12">
            <ol class="breadcrumb">
                <li v-for="breadcrumb in breadcrumbs"
                    :class="{ active: isLast($index) }">
                    <a @click="cd(breadcrumb.path)"
                       v-if="!isLast($index)">
                        {{ breadcrumb.label }}
                    </a>
                <span v-else>
                    {{ breadcrumb.label }}
                </span>
                </li>
            </ol>
        </div>
    </div>
</template>

<script type="text/babel">
    import store from '../store';

    export default {
        methods: {
            isLast(index) {
                return index + 1 === this.breadcrumbs.length
            },
            cd(path) {
                store.actions.changeDirectory(path);
            }
        },

        computed: {
            breadcrumbs() {
                let path = '';
                let mapItem = (label) => {
                    path += label + '/';

                    return {label, path}
                };

                return store.state.path.split('/').map(mapItem);
            }
        }
    }
</script>