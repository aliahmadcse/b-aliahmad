<template>
    <div class="categories-fields text-secondary">
        <h2 v-if="project.id==0" class="text-center">Hmm 🎦, Got a new project.</h2>
        <h2 v-if="project.id>0" class="text-center">Edit your project below</h2>
        <form @submit.prevent class="mt-5">
            <div class="form-row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-12 mb-3">
                    <label for="title">Project title</label>
                    <input
                        type="text"
                        class="form-control"
                        :class="{ 'is-invalid' : errors.title.length }"
                        id="category"
                        name="title"
                        placeholder="Title..."
                        v-model="project.title"
                        autofocus
                    />
                    <div class="invalid-feedback">{{ errors.title[0] }}</div>
                </div>
            </div>
            <div class="text-center">
                <button
                    v-if="project.id==0"
                    @click="addProject"
                    class="btn btn-outline-primary text-center"
                    type="submit"
                >Add Project</button>
                <button
                    v-if="project.id>0"
                    @click="updateProject"
                    class="btn btn-outline-primary text-center btn-update"
                    type="submit"
                >Update Project</button>
            </div>
        </form>
    </div>
</template>

<script>
import VueLoading from "vuejs-loading-plugin";
Vue.use(VueLoading);

export default {
    data: function() {
        return {
            project: {
                id: 0,
                title: "",
                description: "",
                category: "",
                image: "",
                display_order: 0,
                github: "",
                live: ""
            },
            errors: {
                title: [],
                description: [],
                category: [],
                image: [],
                display_order: [],
                github: [],
                live: []
            }
        };
    },

    created: async function() {
        this.$loading(true);
        if (this.$store.state.projects.length == 0) {
            let promise = this.$store.dispatch("getProjects");
            await promise;
        }
        if (this.$route.params.id) {
            this.project = this.$store.getters.projectById(
                this.$route.params.id
            )[0];
        }
        this.$loading(false);
    },

    methods: {
        addProject() {
            this.$loading(true);
            $(".btn").addClass("disabled");
            axios
                .post("/api/project/category/add", {
                    category: this.category
                })
                .then(res => {
                    if (res.status === 201) {
                        this.$store.commit("ADD_PROJECT_CATEGORY", res.data);
                        this.$loading(false);
                        this.$router.push({ name: "project.categories" });
                    }
                })
                .catch(err => {
                    if (err.response.status === 422) {
                        this.errors = err.response.data.errors;
                        $(".btn").removeClass("disabled");
                        this.$loading(false);
                    }
                });
        },

        updateProject() {
            $(".btn-update").addClass("disabled");
            this.$loading(true);
            axios
                .put("/api/project/category/update/" + this.id, {
                    category: this.category
                })
                .then(res => {
                    this.$store.commit("UPDATE_PROJECT_CATEGORY", {
                        id: this.id,
                        category: this.category
                    });
                    this.$loading(false);
                    this.$router.push({ name: "project.categories" });
                })
                .catch(err => {
                    if (err.response.status === 422) {
                        this.errors = err.response.data.errors;
                        $(".btn-update").removeClass("disabled");
                        this.$loading(false);
                    }
                });
        }
    }
};
</script>

<style lang="scss" scoped>
// @import "~@/variables";
</style>