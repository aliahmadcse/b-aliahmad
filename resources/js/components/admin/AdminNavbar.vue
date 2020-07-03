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
                    :class="{active:isBlogTagRoute()}"
                    data-toggle="pill"
                    role="tab"
                    :to="{name:'blog.tags'}"
                >Blog Tags</router-link>

                <router-link
                    class="nav-link"
                    :class="{active:isBlogRoute()}"
                    data-toggle="pill"
                    role="tab"
                    :to="{name:'blogs.posts'}"
                >Blogs</router-link>
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
import ListTags from "./blog/tags/ListTags";
import TagFields from "./blog/tags/TagFields";
import BlogFields from "./blog/BlogFields";
import DisplayBlog from "../blog/DisplayBlog";

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
            return this.$route.name.includes("blogs");
        },
        isBlogTagRoute() {
            return this.$route.name.includes("blog.tags");
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
                        path: "view/:id",
                        name: "projects.view",
                        component: ViewProject
                    },
                    {
                        path: "add",
                        name: "projects.add",
                        component: ProjectFields
                    },
                    {
                        path: "edit/:id",
                        name: "projects.edit",
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
                        name: "blogs.posts",
                        component: ListPosts
                    },
                    {
                        path: "post/add",
                        name: "blogs.add",
                        component: BlogFields
                    },
                    {
                        path: "post/edit/:id",
                        name: "blogs.edit",
                        component: BlogFields,
                        props: true
                    },
                    {
                        path: "preview/:id/:title",
                        name: "blogs.preview",
                        component: DisplayBlog,
                        props: true
                    },

                    // blog tags routes
                    {
                        path: "tags",
                        name: "blog.tags",
                        component: ListTags
                    },
                    {
                        path: "tag/add",
                        name: "blog.tags.add",
                        component: TagFields
                    },
                    {
                        path: "tag/edit/:id",
                        name: "blog.tags.edit",
                        component: TagFields,
                        props: true
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
@import "~@/variables";
@import "~@/mixins";
.admin-nav {
    .nav-custom {
        .nav-link {
            font-family: $font-family-montserrat;
            font-size: $font-size-base * 1.1;
        }
        .active {
            background: $primary;
            color: $white;
        }
    }
}
</style>