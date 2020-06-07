<template>
    <div>
        <router-view></router-view>
    </div>
</template>

<script>
import VueRouter from "vue-router";
Vue.use(VueRouter);

export default {
    router: new VueRouter({})
};
</script>

<style lang="scss" scoped>
</style>