<template>
    <div class="categories-fields text-secondary">
        <h2 class="text-center">Awesome 🙆‍♀️, you got a new category</h2>
        <form @submit.prevent="addCategory" class="mt-5">
            <div class="form-row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-12 mb-3">
                    <label for="validationServer05">Please enter your category below</label>
                    <input
                        type="text"
                        class="form-control"
                        id="validationServer05"
                        placeholder="Your new category name"
                        v-model="category"
                        required
                    />
                    <!-- <div class="invalid-feedback">Please provide a valid zip.</div> -->
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
        addCategory() {}
    }
};
</script>

<style lang="scss" scoped>
@import "~@/variables";

.categories-fields {
    font-family: $font-family-open-sans;
}
</style>