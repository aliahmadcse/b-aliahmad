<template>
    <div>
        <router-link
            class="btn btn-outline-secondary mb-3 ml-3"
            :to="{name:'projects.add'}"
        >Add Project</router-link>
        <table class="table table-striped table-responsive table-project-list">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Github</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="project in projects" :key="project.id">
                    <th scope="row">{{ project.id }}</th>
                    <td scope="row">{{ project.title }}</td>
                    <td scope="row">{{ project.category.category }}</td>
                    <td scope="row">{{ project.github }}</td>
                    <td scope="row">
                        <router-link
                            class="btn btn-outline-secondary"
                            :to="{name:'projects.view',params:{id:project.id}}"
                        >View</router-link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import VueLoading from "vuejs-loading-plugin";
Vue.use(VueLoading);

export default {
    mounted: async function() {
        this.$loading(true);
        if (this.$store.state.projects.length == 0) {
            let promise = this.$store.dispatch("getProjects");
            await promise;
        }
        this.$loading(false);
    },
    created: function() {},

    computed: {
        projects: function() {
            return this.$store.state.projects;
        }
    }
};
</script>

<style lang="scss" scoped>
</style>