<template>
    <div>{{ blog.id }}</div>
</template>

<script>
import VueLoading from "vuejs-loading-plugin";
Vue.use(VueLoading);

export default {
    data: function() {
        return {
            blog: {},
            blogId: 0
        };
    },

    created: function() {
        this.blogId = this.$route.params.id;
    },

    mounted: function() {
        this.$loading(true);
        axios
            .get("/api/blog/" + this.blogId)
            .then(res => {
                this.blog = res.data;
                this.$loading(false);
            })
            .catch(err => {
                console.log(err);
                this.$loading(false);
            });
    }
};
</script>

<style lang="scss" scoped>
@import "~@/variables";
@import "~@/mixins";
</style>