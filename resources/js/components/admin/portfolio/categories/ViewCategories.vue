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
                        class="btn btn-outline-danger"
                        data-toggle="modal"
                        data-target="#confirmModel"
                    >Delete</button>
                </div>
            </div>

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
                            <button
                                type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">Are you sure, You want to delete this category</div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal"
                            >Close</button>
                            <button
                                type="button"
                                class="btn btn-danger"
                                @click="deleteCategory(category.id)"
                            >Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import VueLoading from "vuejs-loading-plugin";
Vue.use(VueLoading);

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
        deleteCategory: function(id) {
            $("#confirmModel").modal("hide");
            $(".btn-danger").addClass("disabled");
            this.$loading(true);
            axios
                .delete("/api/project/category/delete/" + id)
                .then(res => {
                    if (res.status === 204) {
                        this.$store.commit("REMOVE_PROJECT_CATEGORY", id);
                        this.$loading(false);
                        this.$router.push({ name: "project.categories" });
                    }
                })
                .catch(err => {
                    this.$loading(false);
                    console.log(err);
                });
        }
    }
};
</script>

<style lang="scss" scoped>
</style>