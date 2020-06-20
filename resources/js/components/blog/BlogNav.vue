<template>
    <div>
        <router-view></router-view>
    </div>
</template>

<script>
import VueRouter from "vue-router";
Vue.use(VueRouter);

import ListBlogs from "./ListBlogs";
import ListTagBlogs from "./ListTagBlogs";
import DisplayBlog from "./DisplayBlog";

export default {
    router: new VueRouter({
        mode: "history",
        base: "blog",
        routes: [
            {
                path: "/page/:page",
                component: ListBlogs,
                name: "blog.paginate",
                props: true
            },
            {
                path: "/page/:page/:tag/:tagId",
                component: ListTagBlogs,
                name: "tag.blogs",
                props: true
            },
            {
                path: "/:id/:title",
                component: DisplayBlog,
                name: "blog.display",
                props: true
            },
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