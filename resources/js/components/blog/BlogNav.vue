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