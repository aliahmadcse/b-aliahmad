<template>
    <div>
        <div v-for="category in projectCategory" :key="category.id">
            <dl class="row text-center">
                <dt class="col-sm-3">Id:</dt>
                <dd class="col-sm-9">{{ category.id }}</dd>
                <dt class="col-sm-3">Category:</dt>
                <dd class="col-sm-9">{{ category.category }}</dd>
                <dt class="col-sm-3">Created at:</dt>
                <dd class="col-sm-9">{{ formatDateTime(category.created_at) }}</dd>
                <dt class="col-sm-3">Updated at:</dt>
                <dd class="col-sm-9">{{ formatDateTime(category.updated_at) }}</dd>
            </dl>
            <div class="row mt-3">
                <div class="col-12 d-flex justify-content-center">
                    <router-link
                        class="btn btn-outline-secondary mr-5"
                        :to="{name:'project.categories.edit',params:{id:category.id}}"
                    >Edit</router-link>
                    <button
                        @click="deleteCategory(category.id)"
                        class="btn btn-outline-danger"
                    >Delete</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            projectCategory: []
        };
    },

    created: function() {
        this.projectCategory = this.$store.getters.categoryById(
            this.$route.params.id
        );
    },

    methods: {
        deleteCategory: function() {}
    }
};
</script>

<style lang="scss" scoped>
@import "~@/variables";

dl {
    font-family: $font-family-open-sans;
}
</style>