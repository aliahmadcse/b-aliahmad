<template>
    <div>
        <!-- <div v-for="project in projects" :key="project.title">
            <p>{{ project.title }}</p>
        </div> -->
        Ali
    </div>
</template>

<script>
export default {
    computed: {
        projects() {
            return this.$store.state.projects;
        }
    }
};
</script>

<style lang="scss" scoped>
</style>