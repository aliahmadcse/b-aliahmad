<template>
    <div>
        <div v-for="proj in project" :key="proj.id">
            <div class="row mb-4 action-row">
                <div class="col-12 d-flex justify-content-center">
                    <router-link
                        class="btn btn-outline-secondary mr-5"
                        :to="{name:'projects.edit',params:{id:proj.id}}"
                    >Edit</router-link>
                    <button
                        class="btn btn-outline-danger"
                        data-toggle="modal"
                        data-target="#confirmModel"
                    >Delete</button>
                </div>
            </div>

            <dl class="row text-center">
                <dt class="col-sm-3">Id:</dt>
                <dd class="col-sm-9">{{ proj.id }}</dd>
                <dt class="col-sm-3">Category:</dt>
                <dd class="col-sm-9">{{ proj.category.category }}</dd>
                <dt class="col-sm-3">Title:</dt>
                <dd class="col-sm-9">{{ proj.title }}</dd>
                <dt class="col-sm-3">Description:</dt>
                <dd class="col-sm-9">{{ proj.description }}</dd>
                <dt class="col-sm-3">Display Order:</dt>
                <dd class="col-sm-9">{{ proj.display_order }}</dd>
                <dt class="col-sm-3">Github:</dt>
                <dd class="col-sm-9">{{ proj.github }}</dd>
                <dt class="col-sm-3">Live:</dt>
                <dd class="col-sm-9">{{ proj.live }}</dd>
                <dt class="col-sm-3">Created at:</dt>
                <dd class="col-sm-9">{{ formatDateTime(proj.created_at) }}</dd>
                <dt class="col-sm-3">Updated at:</dt>
                <dd class="col-sm-9">{{ formatDateTime(proj.updated_at) }}</dd>
                <dt class="col-sm-3">Image:</dt>
                <dd class="col-sm-9">
                    <img
                        :src="proj.image"
                        class="img-fluid img-thumbnail rounded"
                        :alt="proj.title"
                    />
                </dd>
            </dl>

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
                        <div class="modal-body">Are you sure, You want to delete this project?</div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal"
                            >Close</button>
                            <button
                                type="button"
                                class="btn btn-danger"
                                @click="deleteProject(proj.id)"
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
    mounted: function() {
        if (this.$store.state.projects.length == 0) {
            this.$store.dispatch("getProjects");
        }
    },

    computed: {
        project: function() {
            if (this.$store.state.projects == 0) {
                this.$loading(true);
            } else {
                this.$loading(false);
            }
            return this.$store.getters.projectById(this.$route.params.id);
        }
    },

    methods: {
        deleteProject: function(id) {
            $(".btn-danger").addClass("disabled");
            $("#confirmModel").modal("hide");
            this.$loading(true);
            axios
                .delete("/api/project/delete/" + id)
                .then(res => {
                    if (res.status === 204) {
                        this.$store.commit("REMOVE_PROJECT", id);
                        this.$loading(false);
                        this.$router.push({ name: "projects.list" });
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
.action-row {
    margin-right: 15rem;
}
@media (max-width: 1000px) {
    .action-row {
        margin-right: 0px;
    }
}
</style>