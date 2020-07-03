<template>
    <div class="blog-fields text-secondary">
        <h2 v-if="id==0" class="text-center">Hmm 🎦, Got a new Blog.</h2>
        <h2 v-if="id>0" class="text-center">Edit your blog below</h2>
        <form @submit.prevent class="mt-5">
            <div class="form-row justify-content-center">
                <!-- preview and delete buttons -->
                <div
                    class="col-lg-10 col-md-10 col-sm-12 mb-3 d-lg-flex justify-content-around flex-xl-row flex-lg-column"
                >
                    <router-link
                        v-if="id>0 && fetched"
                        :to="{name:'blogs.preview',params:{title:formatTitle(blog.title),id:id}}"
                    >
                        <button class="btn btn-primary">Preview Blog</button>
                    </router-link>

                    <button
                        v-if="id>0"
                        data-toggle="modal"
                        data-target="#confirmModel"
                        class="btn btn-danger m-2"
                    >Delete Blog</button>
                </div>
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
                        v-model="blog.title"
                        autofocus
                    />
                    <div class="invalid-feedback">{{ errors.title[0] }}</div>
                </div>
                <!-- description -->
                <div class="col-lg-10 col-md-10 col-sm-12 mb-3">
                    <label for="description">Blog Description</label>
                    <textarea
                        class="form-control"
                        :class="{ 'is-invalid' : errors.description.length }"
                        id="description"
                        name="description"
                        rows="3"
                        placeholder="Description..."
                        v-model="blog.description"
                    ></textarea>
                    <div class="invalid-feedback">{{ errors.description[0] }}</div>
                </div>
                <!-- blog tag -->
                <div class="col-lg-10 col-md-10 col-sm-12 mb-3">
                    <label for="blog_tag_id">Blog tag</label>
                    <select
                        class="custom-select"
                        :class="{ 'is-invalid' : errors.blog_tag_id.length }"
                        id="blog_tag_id"
                        name="blog_tag_id"
                        v-model="blog.blog_tag_id"
                    >
                        <option
                            v-for="tag in tags"
                            :key="tag.id"
                            :value="tag.id"
                        >{{ capitalize(tag.tag) }}</option>
                    </select>
                    <div class="invalid-feedback">{{ errors.blog_tag_id[0] }}</div>
                </div>

                <!-- Image -->
                <div class="col-lg-10 col-md-10 col-sm-12 mb-3">
                    <label for="dropzone">Blog Image</label>
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
                <!-- Blog body -->
                <div class="col-lg-10 col-md-10 col-sm-12 mb-3">
                    <label for="body">Blog Body</label>
                    <textarea
                        class="form-control"
                        :class="{ 'is-invalid' : errors.body.length }"
                        id="body"
                        name="body"
                        rows="5"
                        placeholder="Blog body ..."
                        v-model="blog.body"
                    ></textarea>
                    <div class="invalid-feedback">{{ errors.body[0] }}</div>
                </div>

                <!-- submit buttons -->
                <div class="col-lg-10 col-md-10 col-sm-12 mb-3 d-flex justify-content-around">
                    <button
                        @click="saveBlog(status='save')"
                        class="btn btn-primary text-center"
                        type="submit"
                    >Save Draft</button>
                    <button
                        @click="saveBlog(status='publish')"
                        class="btn btn-primary text-center btn-update"
                        type="submit"
                    >Publish</button>
                </div>
            </div>
        </form>

        <!-- Model for delete confirmation -->
        <div
            class="modal fade"
            id="confirmModel"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirm Delete ❌ ?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure, You want to delete blog
                        <strong>{{ blog.title }}</strong>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" @click="deleteBlog">Delete</button>
                    </div>
                </div>
            </div>
        </div>
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
            fetched: false,
            // dropzone configurations
            dropzoneOptions: {
                url: "/api/blogs/header/image/add",
                thumbnailWidth: 150,
                maxFilesize: 1,
                maxFiles: 1,
                addRemoveLinks: true,
                acceptedFiles: ".png,.gif,.jpg,.jpeg",
                headers: {
                    "X-CSRF-TOKEN": document.head.querySelector(
                        'meta[name="csrf-token"]'
                    ).content
                }
            },

            blog: {
                title: "",
                description: "",
                blog_tag_id: "",
                author_id: null,
                image: "",
                body: "",
                is_published: null
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

    async created() {
        if (this.$route.params.id) {
            this.id = this.$route.params.id;
        }
    },

    async mounted() {
        this.$loading(true);
        if (!this.$store.state.blogTags.length) {
            await this.$store.dispatch("getBlogTags");
        }
        if (this.id > 0) {
            await this.$store.dispatch("getBlog", this.id);
            this.blog = this.$store.state.blog;
            this.fetched = true;
        }
        this.$loading(false);
    },

    methods: {
        saveBlog(status) {
            this.blog.is_published = status === "save" ? 0 : 1;
            this.$loading(true);
            axios
                .post("/api/blogs/add", this.blog)
                .then(res => {
                    if (res.status === 201) {
                        this.$store.commit("ADD_BLOG_POST", res.data);
                        this.$loading(false);
                        this.$router.push({ name: "blogs.posts" });
                    }
                })
                .catch(err => {
                    if (err.response.status === 422) {
                        this.assignErrors(err.response.data.errors);
                    }
                    this.$loading(false);
                });
        },

        deleteBlog() {
            $("#confirmModel").modal("hide");
            this.$loading(true);
            axios
                .delete("/api/blogs/delete/" + this.id)
                .then(res => {
                    if (res.status === 204) {
                        this.$store.commit("REMOVE_BLOG_POST", this.id);
                        this.$loading(false);
                        this.$router.push({ name: "blogs.posts" });
                    }
                })
                .catch(err => {
                    console.log(err);
                    this.$loading(false);
                });
        },

        uploadImageSuccess: function(file, res) {
            this.blog.image = res;
        },

        removeImage: function(file, error, xhr) {
            const imagePath = file.xhr.response;
            axios
                .delete("/api/blogs/header/image/delete", {
                    data: {
                        imgPath: imagePath
                    }
                })
                .then(res => {
                    this.blog.image = "";
                })
                .catch(err => {
                    console.log(err);
                });
        },

        /**
         * Assign errors to the errors data object
         *
         * @param {object} errors the errors object returned from server
         * @returns void
         */
        assignErrors: function(errors) {
            // removing old errors
            for (const error in this.errors) {
                this.errors[error] = [];
            }
            // assigning new errors
            for (const error in errors) {
                if (errors.hasOwnProperty(error)) {
                    this.errors[error] = errors[error];
                }
            }
        }
    },

    computed: {
        customSlot: function() {
            return this.id === 0
                ? "Drop an image 📸 here to upload"
                : "Drop an image 📸 here to update";
        },

        tags() {
            return this.$store.state.blogTags;
        }
    }
};
</script>

<style lang="scss" scoped>
// @import "~@/variables";
.invalid-feedback {
    display: block;
}
</style>