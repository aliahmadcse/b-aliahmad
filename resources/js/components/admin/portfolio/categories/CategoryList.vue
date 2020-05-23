<template>
    <div>
        <router-link
            class="btn btn-outline-secondary mb-3 ml-3"
            :to="{name:'project.categories.add'}"
        >Add New Catgeory</router-link>
        <div class="table-responsive">
            <table class="table table-striped text-center table-project-list">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Category</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="projectCategory in projectCategories" :key="projectCategory.id">
                        <th scope="row">{{ projectCategory.id }}</th>
                        <td scope="row">{{ projectCategory.category }}</td>
                        <td scope="row">
                            <router-link
                                class="btn btn-outline-secondary"
                                :to="{name:'project.categories.view'}"
                            >View</router-link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    computed: {
        projectCategories() {
            return this.$store.getters.categories;
        }
    }
};
</script>

<style lang="scss" scoped>
</style>