<template>
    <div>{{ id }}</div>
</template>

<script>
export default {
    data: function() {
        return {
            blogId: 0
        };
    },

    created: function() {
        this.blogId = this.$route.params.id;
    },

    computed: {
        id: function() {
            return this.blogId;
        }
    }
};
</script>

<style lang="scss" scoped>
@import "~@/variables";
@import "~@/mixins";
</style>