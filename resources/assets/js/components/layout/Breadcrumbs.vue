<template>
    <div class="row">
        <div class="breadcrumbs col-md-12">
            <ol class="breadcrumb">
                <li v-for="breadcrumb in breadcrumbs"
                    :class="{ active: isLast($index) }">
                    <a @click="cd(($index === 0 ? '' : '/') + breadcrumb.path)"
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
    import * as types from '../../store/types'
    import { mapActions, mapState } from 'vuex'

    export default {
        methods: {
            ...mapActions({
                cd: types.CHANGE_DIRECTORY
            }),
            isLast(index) {
                return index + 1 === this.breadcrumbs.length
            }
        },
        computed: {
            ...mapState({
                path: state => state.path
            }),
            breadcrumbs() {
                const root = [{label: Laravel.host, path: ''}];

                let path = '';
                let mapItem = label => {
                    path += label + '/';
                    return {label, path}
                };

                return root.concat(this.path.slice(1, -1).split('/').map(mapItem));
            }
        }
    }
</script>