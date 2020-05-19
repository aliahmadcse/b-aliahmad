<template>
    <div>
        <ul class="nav nav-tabs portfolio-main" role="tablist">
            <li class="nav-item" role="presentation">
                <router-link
                    class="nav-link px-5 prlink"
                    data-toggle="tab"
                    role="tab"
                    aria-controls="home"
                    aria-selected="true"
                    :to="{ name:'all' }"
                >All</router-link>
            </li>
            <li class="nav-item" role="presentation">
                <router-link
                    class="nav-link px-5 prlink"
                    data-toggle="tab"
                    role="tab"
                    aria-controls="profile"
                    aria-selected="false"
                    :to="{ name:'web' }"
                >Web</router-link>
            </li>
            <li class="nav-item" role="presentation">
                <router-link
                    class="nav-link px-5 prlink"
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
import DisplayProjects from "./DisplayProjects";

Vue.use(VueRouter);

export default {
    props: ["projects"],
    
    created: function() {
        this.$store.commit("SET_PROJECTS", this.projects);
    },

    // adding the active class to active router-link dynamically
    mounted: function() {
        const eleArr = document.querySelectorAll(".prlink");
        eleArr.forEach(ele => {
            ele.classList.contains("router-link-active")
                ? ele.classList.add("active")
                : "";
        });
    },

    router: new VueRouter({
        mode: "history",
        base: "portfolio",
        routes: [
            {
                path: "/all",
                name: "all",
                component: DisplayProjects
            },
            {
                path: "/web",
                name: "web",
                component: DisplayProjects
            },
            {
                path: "/ml",
                name: "ml",
                component: DisplayProjects
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