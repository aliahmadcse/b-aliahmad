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
                    :class="{active:isProjectRoute()}"
                    data-toggle="pill"
                    role="tab"
                    :to="{name:'projects.list'}"
                >Projects</router-link>

                <router-link
                    class="nav-link"
                    :class="{active:isCategoryRoute()}"
                    data-toggle="pill"
                    role="tab"
                    :to="{name:'project.categories'}"
                >Project Categories</router-link>

                <router-link
                    class="nav-link"
                    :class="{active:isBlogRoute()}"
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
import ViewProject from "./portfolio/ViewProject";
import ProjectFields from "./portfolio/ProjectFields";
import CategoryList from "./portfolio/categories/CategoryList";
import CategoryFields from "./portfolio/categories/CategoryFields";
import ViewCategories from "./portfolio/categories/ViewCategories";

import BlogNav from "./blog/BlogNav";
import ListPosts from "./blog/ListPosts";

Vue.use(VueRouter);

export default {
    props: ["project_categories"],

    created: function() {
        this.$store.commit(
            "SET_PROJECT_CATEGORIES",
            _.cloneDeep(this.project_categories)
        );
    },

    methods: {
        isProjectRoute() {
            return this.$route.name.includes("projects");
        },
        isBlogRoute() {
            return this.$route.name.includes("blog");
        },
        isCategoryRoute() {
            return this.$route.name.includes("project.categories");
        }
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
                    },
                    {
                        path: "view",
                        name: "project.view",
                        component: ViewProject
                    },
                    {
                        path: "add",
                        name: "project.add",
                        component: ProjectFields
                    },
                    {
                        path: "edit/:id",
                        name: "project.edit",
                        component: ProjectFields,
                        props: true
                    },

                    // project categories route
                    {
                        path: "categories/list",
                        name: "project.categories",
                        component: CategoryList
                    },
                    {
                        path: "categories/add",
                        name: "project.categories.add",
                        component: CategoryFields
                    },
                    {
                        path: "categories/edit/:id",
                        name: "project.categories.edit",
                        component: CategoryFields,
                        props: true
                    },
                    {
                        path: "categories/view/:id",
                        name: "project.categories.view",
                        component: ViewCategories
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