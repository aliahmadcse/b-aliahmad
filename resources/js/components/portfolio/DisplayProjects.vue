<template>
    <div class="row">
        <div class="col-sm-6 col-lg-4 mb-4" v-for="project in projects" :key="project.id">
            <div class="card h-100 project-card">
                <a
                    href="https://tiny.pictures/api/demo/main/example1.jpg?width=400"
                    :data-lightbox="project.id"
                    :data-title="project.title"
                    :data-alt="project.title"
                >
                    <img
                        class="card-img-top"
                        src="https://tiny.pictures/api/demo/main/example1.jpg?width=400"
                        :alt="project.title"
                    />
                </a>
                <div class="card-body text-center">
                    <h5 class="card-title">
                        <em>{{ project.title }}</em>
                    </h5>
                    <p
                        class="card-text lead"
                    >Lorem ipsum dolor sit, amet consectetur adipisicing elit. Pariatur, temporibus!</p>
                    <div class="d-flex justify-content-center">
                        <a class="card-link mx-2" :href="project.github">
                            <i title="Learn More" class="fab fa-github card-link-github"></i>
                        </a>
                        <a class="card-link" :href="project.link">
                            <i title="Live Project" class="fas fa-external-link-alt card-link-live"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// lightbox2
import lightbox2 from "lightbox2/dist/js/lightbox";
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