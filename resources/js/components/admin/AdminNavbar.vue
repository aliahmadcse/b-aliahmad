<template>
    <div>
        <router-link :to="{name:'projects.list'}">Projects</router-link>
        <router-link :to="{name:'blog.posts'}">Blog</router-link>

        <router-view></router-view>
    </div>
</template>

<script>
import VueRouter from "vue-router";

import ProjectsNav from "./portfolio/ProjectsNav";
import ListProjects from "./portfolio/ListProjects";

import BlogNav from "./blog/BlogNav";
import ListPosts from "./blog/ListPosts";

Vue.use(VueRouter);

export default {
    props: ["projects"],

    created: function() {
        this.$store.commit("SET_PROJECTS", _.cloneDeep(this.projects));
    },

    // Here we create the routes for admin panel
    router: new VueRouter({
        mode: "history",
        base: "home",
        // top level routes
        routes: [
            // route for projects
            {
                path: "/projects",
                name: "projects",
                component: ProjectsNav,
                children: [
                    {
                        path: "list",
                        name: "projects.list",
                        component: ListProjects
                    }
                ]
            },
            // route for blog posts
            {
                path: "/blog",
                name: "blog",
                component: BlogNav,
                children: [
                    {
                        path: "posts",
                        name: "blog.posts",
                        component: ListPosts
                    }
                ]
            },
            // default route
            {
                path: "/",
                redirect: { name: "projects.list" }
            }
        ]
    })
};
</script>

<style lang="scss" scoped>
</style>