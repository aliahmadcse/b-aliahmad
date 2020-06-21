<template>
    <div class="categories-fields text-secondary">
        <h2 v-if="id==0" class="text-center">Awesome 😎, you got a new tag</h2>
        <h2 v-if="id>0" class="text-center">Edit your tag below</h2>
        <form @submit.prevent class="mt-5">
            <div class="form-row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-12 mb-3">
                    <label for="category">Please enter your tag below</label>
                    <input
                        type="text"
                        class="form-control"
                        :class="{ 'is-invalid' : errors.tag.length }"
                        id="tag"
                        name="tag"
                        placeholder="Your new blog tag name"
                        v-model="tag"
                        autofocus
                    />
                    <div class="invalid-feedback">{{ errors.tag[0] }}</div>
                </div>
            </div>
            <div class="text-center">
                <button
                    v-if="id==0"
                    @click="addTag"
                    class="btn btn-outline-primary text-center"
                    type="submit"
                >Add Tag</button>
                <button
                    v-if="id>0"
                    @click="updateTag"
                    class="btn btn-outline-primary text-center btn-update"
                    type="submit"
                >Update Tag</button>
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
            tag: "",
            errors: {
                tag: []
            },
            id: 0
        };
    },

    created: async function() {
        this.$loading(true);
        if (this.$store.state.blogTags.length === 0) {
            let promise = this.$store.dispatch("getBlogTags");
            await promise;
        }
        this.$loading(false);
        if (this.$route.params.id) {
            this.id = this.$route.params.id;
            const blogTagArr = this.$store.getters.blogTagById(this.id);
            this.tag = blogTagArr[0].tag;
        }
    },

    methods: {
        addTag() {
            this.$loading(true);
            $(".btn").addClass("disabled");
            axios
                .post("/api/blog/tags/add", {
                    tag: this.tag
                })
                .then(res => {
                    if (res.status === 201) {
                        this.$store.commit("ADD_BLOG_TAG", res.data);
                        this.$loading(false);
                        this.$router.push({ name: "blog.tags" });
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

        updateTag() {
            $(".btn-update").addClass("disabled");
            this.$loading(true);
            axios
                .put("/api/blog/tags/update/" + this.id, {
                    tag: this.tag
                })
                .then(res => {
                    this.$store.commit("UPDATE_BLOG_TAG", {
                        id: this.id,
                        tag: this.tag
                    });
                    this.$loading(false);
                    this.$router.push({ name: "blog.tags" });
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