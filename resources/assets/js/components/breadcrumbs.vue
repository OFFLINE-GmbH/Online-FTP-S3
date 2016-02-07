<template>
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
</template>

<script type="text/babel">
    export default {
        props: ['path'],

        methods: {
            isLast(index) {
                return index + 1 == this.breadcrumbs.length
            }
        },

        computed: {
            breadcrumbs() {
                let path = '';
                return this.path.split('/')
                        .map(item => {
                            path += item + '/';
                            return {
                                label: item,
                                path
                            }
                        });
            }
        }
    }
</script>