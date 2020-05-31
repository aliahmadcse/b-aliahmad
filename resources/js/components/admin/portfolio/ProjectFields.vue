<template>
    <div class="categories-fields text-secondary">
        <h2 v-if="project.id==0" class="text-center">Hmm 🎦, Got a new project.</h2>
        <h2 v-if="project.id>0" class="text-center">Edit your project below</h2>
        <form @submit.prevent class="mt-5">
            <div class="form-row justify-content-center">
                <!-- title -->
                <div class="col-lg-10 col-md-10 col-sm-12 mb-3">
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
                <!-- description -->
                <div class="col-lg-10 col-md-10 col-sm-12 mb-3">
                    <label for="description">Project Description</label>
                    <textarea
                        class="form-control"
                        :class="{ 'is-invalid' : errors.description.length }"
                        id="description"
                        name="description"
                        rows="2"
                        placeholder="Description..."
                        v-model="project.description"
                    ></textarea>
                    <div class="invalid-feedback">{{ errors.description[0] }}</div>
                </div>
                <!-- category -->
                <div class="col-lg-10 col-md-10 col-sm-12 mb-3">
                    <label for="category">Project Category</label>
                    <select
                        class="custom-select"
                        :class="{ 'is-invalid' : errors.category.length }"
                        id="category"
                        name="category"
                        v-model="project.project_category_id"
                    >
                        <option
                            v-for="category in categories"
                            :key="category.id"
                            :value="category.id"
                        >{{ capitalize(category.category) }}</option>
                    </select>
                    <div class="invalid-feedback">{{ errors.category[0] }}</div>
                </div>
                <!-- github url -->
                <div class="col-lg-10 col-md-10 col-sm-12 mb-3">
                    <label for="github">Github Link</label>
                    <input
                        type="text"
                        class="form-control"
                        :class="{ 'is-invalid' : errors.github.length }"
                        id="github"
                        name="github"
                        placeholder="Github URL ..."
                        v-model="project.github"
                    />
                    <div class="invalid-feedback">{{ errors.github[0] }}</div>
                </div>
                <!-- live url -->
                <div class="col-lg-10 col-md-10 col-sm-12 mb-3">
                    <label for="live">Live Link</label>
                    <input
                        type="text"
                        class="form-control"
                        :class="{ 'is-invalid' : errors.live.length }"
                        id="live"
                        name="live"
                        placeholder="Live URL ..."
                        v-model="project.live"
                    />
                    <div class="invalid-feedback">{{ errors.live[0] }}</div>
                </div>
                <!-- display order -->
                <div class="col-lg-10 col-md-10 col-sm-12 mb-3">
                    <label for="display-order">Display Order</label>
                    <select
                        class="custom-select"
                        :class="{ 'is-invalid' : errors.display_order.length }"
                        id="display-order"
                        name="display-order"
                        v-model="project.display_order"
                    >
                        <option v-for="item in totalProjects" :key="item" :value="item">{{ item }}</option>
                    </select>
                    <div class="invalid-feedback">{{ errors.display_order[0] }}</div>
                </div>
                <!-- Image -->
                <div class="col-lg-10 col-md-10 col-sm-12 mb-3">
                    <label for="dropzone">Project Image</label>
                    <vue-dropzone
                        :class="{ 'is-invalid' : errors.image.length }"
                        ref="dropzone"
                        id="dropzone"
                        :options="dropzoneOptions"
                    ></vue-dropzone>
                    <div class="invalid-feedback">{{ errors.image[0] }}</div>
                </div>
            </div>
            <!-- submit buttons -->
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
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";

import VueLoading from "vuejs-loading-plugin";
Vue.use(VueLoading);

export default {
    components: {
        vueDropzone: vue2Dropzone
    },

    data: function() {
        return {
            dropzoneOptions: {
                url: "/api/project/image/add",
                thumbnailWidth: 200,
                headers: {
                    "X-CSRF-TOKEN": document.head.querySelector(
                        'meta[name="csrf-token"]'
                    ).content
                }
            },
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

    computed: {
        categories: function() {
            return this.$store.getters.categories;
        },

        totalProjects: function() {
            const NoOfProjects = this.$store.state.projects.length + 1;
            return NoOfProjects;
        }
    },

    methods: {
        addProject() {
            this.$loading(true);
            $(".btn").addClass("disabled");
            axios
                .post("/api/project/add", this.project)
                .then(res => {
                    if (res.status === 201) {
                        this.$store.commit("ADD_PROJECT", res.data);
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