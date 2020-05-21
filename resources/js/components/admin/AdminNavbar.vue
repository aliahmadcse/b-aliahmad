<template>
    <div>
        <router-link :to="{name:'project-list'}">Projects</router-link>
        <router-view></router-view>
    </div>
</template>

<script>
import VueRouter from "vue-router";
import ListProjects from "./portfolio/ListProjects";

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
        routes: [
            {
                path: "/project-list",
                name: "project-list",
                component: ListProjects
            },
            {
                path: "/",
                redirect: { name: "project-list" }
            }
        ]
    })
};
</script>

<style lang="scss" scoped>
</style>