<template>
    <div>
        <router-view></router-view>
    </div>
</template>

<script>
import VueRouter from "vue-router";
Vue.use(VueRouter);

import ListBlogs from "./ListBlogs";

export default {
    props: ["blogs"],

    created: function() {
        console.log(this.blogs);
        this.$store.commit("SET_BLOGS", _.cloneDeep(this.blogs));
    },

    router: new VueRouter({
        mode: "history",
        base: "blog",
        routes: [
            {
                path: "/",
                component: ListBlogs,
                name: "blog.list"
            }
        ]
    })
};
</script>

<style lang="scss" scoped>
</style>