<template>
    <div class="categories-fields text-secondary">
        <h2 class="text-center">Awesome 🙆‍♀️, you got a new category</h2>
        <form @submit.prevent="addCategory" class="mt-5">
            <div class="form-row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-12 mb-3">
                    <label for="category">Please enter your category below</label>
                    <input
                        type="text"
                        class="form-control"
                        id="category"
                        placeholder="Your new category name"
                        v-model="category"
                    />
                    <div class="invalid-feedback">Please provide a valid zip.</div>
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-outline-primary text-center" type="submit">Add Category</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            category: ""
        };
    },
    methods: {
        addCategory() {
            axios
                .post("/api/project/category/add", {
                    category: this.category
                })
                .then(res => {
                    res.status === 201 ? console.log(res.data) : "";
                })
                .catch(err => {
                    err.response.status === 422
                        ? console.log(err.response.data.errors)
                        : "";
                });
        }
    }
};
</script>

<style lang="scss" scoped>
@import "~@/variables";

.categories-fields {
    font-family: $font-family-open-sans;
}
</style>