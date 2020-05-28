<template>
    <div class="categories-fields text-secondary">
        <h2 v-if="id==0" class="text-center">Awesome 🙆‍♀️, you got a new category</h2>
        <h2 v-if="id>0" class="text-center">Edit your category below</h2>
        <form @submit.prevent class="mt-5">
            <div class="form-row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-12 mb-3">
                    <label for="category">Please enter your category below</label>
                    <input
                        type="text"
                        class="form-control"
                        :class="{ 'is-invalid' : errors.category.length }"
                        id="category"
                        name="catgeory"
                        placeholder="Your new category name"
                        v-model="category"
                        autofocus
                    />
                    <div class="invalid-feedback">{{ errors.category[0] }}</div>
                </div>
            </div>
            <div class="text-center">
                <button
                    v-if="id==0"
                    @click="addCategory"
                    class="btn btn-outline-primary text-center"
                    type="submit"
                >Add Category</button>
                <button
                    v-if="id>0"
                    @click="updateCategory"
                    class="btn btn-outline-primary text-center btn-update"
                    type="submit"
                >Update Category</button>
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
            category: "",
            errors: {
                category: []
            },
            id: 0
        };
    },

    created: function() {
        if (this.$route.params.id) {
            this.id = this.$route.params.id;
        }
    },

    mounted: function() {
        if (this.$route.params.id) {
            const categoryArr = this.$store.getters.categoryById(this.id);
            this.category = categoryArr[0].category;
        }
    },

    methods: {
        addCategory() {
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

        updateCategory() {
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