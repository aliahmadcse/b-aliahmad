<template>
    <div>
        <div v-for="project in projects" :key="project.title">
            <p>{{ project.title }}</p>
        </div>
    </div>
</template>

<script>
export default {
    computed: {
        projects() {
            if (this.$route.name == "web") {
                return this.$store.getters.webProjects;
            } else if (this.$route.name == "ml") {
                return this.$store.getters.mlProjects;
            } else {
                return this.$store.getters.projects;
            }
        }
    }
};
</script>

<style lang="scss" scoped>
</style>