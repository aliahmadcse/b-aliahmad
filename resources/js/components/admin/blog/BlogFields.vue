<template>
    <div class="blog-fields text-secondary">
        <h2 v-if="id==0" class="text-center">Hmm 🎦, Got a new Blog.</h2>
        <h2 v-if="id>0" class="text-center">Edit your blog below</h2>
        <form @submit.prevent class="mt-5">
            <div class="form-row justify-content-center">
                <!-- title -->
                <div class="col-lg-10 col-md-10 col-sm-12 mb-3">
                    <label for="title">Blog title</label>
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
                    <label for="project_category_id">Project Category</label>
                    <select
                        class="custom-select"
                        :class="{ 'is-invalid' : errors.project_category_id.length }"
                        id="project_category_id"
                        name="project_category_id"
                        v-model="project.project_category_id"
                    >
                        <option
                            v-for="category in categories"
                            :key="category.id"
                            :value="category.id"
                        >{{ capitalize(category.category) }}</option>
                    </select>
                    <div class="invalid-feedback">{{ errors.project_category_id[0] }}</div>
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
                    <img
                        v-if="id>0 && project.image"
                        :src="project.image "
                        class="img-fluid img-thumbnail rounded"
                        :alt="project.title"
                    />
                    <vue-dropzone
                        ref="dropzone"
                        id="dropzone"
                        :useCustomSlot="true"
                        :destroyDropzone="false"
                        :options="dropzoneOptions"
                        @vdropzone-success="uploadImageSuccess"
                        @vdropzone-removed-file="removeImage"
                    >{{ customSlot }}</vue-dropzone>
                    <div class="invalid-feedback">{{ errors.image[0] }}</div>
                </div>
            </div>
            <!-- submit buttons -->
            <div class="text-center">
                <button
                    @click="saveBlog"
                    class="btn btn-outline-primary text-center"
                    type="submit"
                >Save Draft</button>
                <button
                    @click="saveBlog"
                    class="btn btn-outline-primary text-center btn-update"
                    type="submit"
                >Publish</button>
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
    data() {
        return {
            id: 0,

            blog: {
                title: "",
                description: "",
                blog_tag_id: "",
                image: "",
                body: ""
            },
            errors: {
                title: [],
                description: [],
                blog_tag_id: [],
                image: [],
                body: []
            }
        };
    },
    components: {
        vueDropzone: vue2Dropzone
    },

    created: {},

    methods: {
        saveBlog() {}
    },

    computed: {}
};
</script>

<style lang="scss" scoped>
@import "~@/variables";
</style>