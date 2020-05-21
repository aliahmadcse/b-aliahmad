<template>
    <div class="row mt-3">
        <div class="col-lg-3 col-md-6 admin-nav">
            <div
                class="nav nav-custom flex-column text-center nav-pills border rounded"
                role="tablist"
                aria-orientation="vertical"
            >
                <router-link
                    class="nav-link"
                    data-toggle="pill"
                    role="tab"
                    :to="{name:'projects.list'}"
                >Projects</router-link>

                <router-link
                    class="nav-link"
                    data-toggle="pill"
                    role="tab"
                    :to="{name:'blog.posts'}"
                >Blog</router-link>
            </div>
        </div>
        <div class="col-lg-9 col-md-6 mt-3">
            <router-view></router-view>
        </div>
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

    mounted: function() {
        const eleArr = document.querySelectorAll(".nav-link");
        eleArr.forEach(ele => {
            ele.classList.contains("router-link-active")
                ? ele.classList.add("active")
                : "";
        });
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