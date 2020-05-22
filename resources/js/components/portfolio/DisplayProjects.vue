<template>
    <div>
        <ul class="nav nav-tabs portfolio-main" role="tablist">
            <li class="nav-item" role="presentation">
                <a
                    @click="getProjects('all')"
                    class="nav-link px-5 prlink active"
                    data-toggle="tab"
                    role="tab"
                >All</a>
            </li>
            <li v-for="category in categories" :key="category" class="nav-item" role="presentation">
                <a
                    @click="getProjects(category)"
                    class="nav-link px-5 prlink"
                    data-toggle="tab"
                    role="tab"
                >{{ category }}</a>
            </li>
        </ul>

        <div class="row mt-5">
            <div class="col-sm-6 col-lg-4 mb-4" v-for="project in projects" :key="project.id">
                <div class="card h-100 project-card">
                    <a
                        :href="project.image"
                        :data-lightbox="project.id"
                        :data-title="project.title"
                        :data-alt="project.title"
                    >
                        <img class="card-img-top" :src="project.image" :alt="project.title" />
                    </a>
                    <div class="card-body text-center">
                        <h5 class="card-title">
                            <em>{{ project.title }}</em>
                        </h5>
                        <p class="card-text lead">{{project.description}}</p>
                        <div class="d-flex justify-content-center">
                            <a class="card-link mx-2" :href="project.github">
                                <i title="Learn More" class="fab fa-github card-link-github"></i>
                            </a>
                            <a class="card-link" :href="project.live">
                                <i
                                    title="Live Project"
                                    class="fas fa-external-link-alt card-link-live"
                                ></i>
                            </a>
                        </div>
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
    props: ["project_categories"],

    data: function() {
        return {
            projects: []
        };
    },

    created: function() {
        this.$store.commit(
            "SET_PROJECT_CATEGORIES",
            _.cloneDeep(this.project_categories)
        );
    },

    mounted: function() {
        this.projects = this.$store.getters.allProjects;
    },

    computed: {
        categories() {
            return this.$store.getters.categories;
        }
    },

    methods: {
        getProjects: function(category) {
            this.projects = this.$store.getters.projectsByCategory(category);
        }
    }
};
</script>

<style lang="scss" scoped>
@import "~@/variables";
.portfolio-main {
    li {
        a {
            font-family: $font-family-montserrat;
            color: $blue;
            font-size: $font-size-base * 1.2;
            cursor: pointer;
            text-transform: uppercase;
        }
    }
}
</style>