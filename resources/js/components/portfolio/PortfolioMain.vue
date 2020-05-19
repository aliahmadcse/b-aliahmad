<template>
    <div>
        <ul class="nav nav-tabs portfolio-main" role="tablist">
            <li class="nav-item" role="presentation">
                <router-link
                    class="nav-link active px-5"
                    data-toggle="tab"
                    role="tab"
                    aria-controls="home"
                    aria-selected="true"
                    :to="{ name:'all' }"
                >All</router-link>
            </li>
            <li class="nav-item" role="presentation">
                <router-link
                    class="nav-link px-5"
                    data-toggle="tab"
                    role="tab"
                    aria-controls="profile"
                    aria-selected="false"
                    :to="{ name:'web' }"
                >Web</router-link>
            </li>
            <li class="nav-item" role="presentation">
                <router-link
                    class="nav-link px-5"
                    data-toggle="tab"
                    role="tab"
                    aria-controls="profile"
                    aria-selected="false"
                    :to="{ name:'ml' }"
                >ML</router-link>
            </li>
        </ul>

        <router-view class="view-router"></router-view>
    </div>
</template>

<script>
import VueRouter from "vue-router";
import AllProjects from "./AllProjects";
import WebProjects from "./WebProjects";
import MLProjects from "./MLProjects";
Vue.use(VueRouter);

export default {
    props: [],
    router: new VueRouter({
        mode: "history",
        base: "portfolio",
        routes: [
            {
                path: "/all",
                name: "all",
                component: AllProjects
            },
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
                redirect: { name: "all" }
            },
            {
                path: "*",
                redirect: "/"
            }
        ]
    })
};
</script>

<style scoped>
.view-router {
    margin-top: 40px;

}
</style>