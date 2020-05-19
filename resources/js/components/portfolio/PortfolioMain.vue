<template>
    <div>
        <router-link :to="{ name:'web' }">Web</router-link>

        <router-link :to="{ name:'ml' }">ML</router-link>

        <router-view class="view-router"></router-view>
    </div>
</template>

<script>
import Vue from "vue";
import VueRouter from "vue-router";
import WebProjects from "./WebProjects";
import MLProjects from "./MLProjects";
Vue.use(VueRouter);

export default {
    props: [],
    router: new VueRouter({
        mode: "history",
        base: "projects",
        routes: [
            {
                path: "/web",
                name: "web",
                component: WebProjects
            },
            {
                path: "/ml",
                name: "ml",
                component: MLProjects
            },
            {
                path: "/",
                redirect: { name: "web" }
            },
            {
                path: "*",
                redirect: "/"
            }
        ]
    })
};
</script>

<style lang="scss" scoped>
</style>