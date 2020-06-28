<template>
    <div>
        <router-link
            class="btn btn-outline-secondary mb-3 ml-3"
            :to="{name:'blog.tags.add'}"
        >Add a Tag</router-link>
        <div class="table-responsive">
            <table class="table table-striped text-center table-project-list">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Tag</th>
                        <th scope="col" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="tag in blogTags" :key="tag.id">
                        <th scope="row">{{ tag.id }}</th>
                        <td scope="row">{{ tag.tag }}</td>
                        <td scope="row">
                            <router-link
                                class="mr-3"
                                :to="{name:'blog.tags.edit',params:{id:tag.id}}"
                            >
                                <i class="far fa-edit icon-edit text-secondary"></i>
                            </router-link>
                            <i
                                class="text-danger icon-delete far fa-trash-alt"
                                data-toggle="modal"
                                data-target="#confirmModel"
                                @click="setDataTag(tag.id,tag.tag)"
                            ></i>
                        </td>
                    </tr>
                </tbody>
            </table>
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
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure, You want to delete tag
                        <strong>{{ tag }}</strong>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" @click="deleteTag(id)">Delete</button>
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
    data() {
        return {
            id: null,
            tag: ""
        };
    },
    async created() {
        this.$loading(true);
        if (this.$store.state.blogTags.length === 0) {
            let promise = this.$store.dispatch("getBlogTags");
            await promise;
        }
        this.$loading(false);
    },

    computed: {
        blogTags() {
            return this.$store.state.blogTags;
        }
    },

    methods: {
        deleteTag(id) {
            $("#confirmModel").modal("hide");
            this.$loading(true);
            axios
                .delete("/api/blog/tags/delete/" + id)
                .then(res => {
                    if (res.status === 204) {
                        this.$store.commit("REMOVE_BLOG_TAG", id);
                        this.$loading(false);
                    }
                })
                .catch(err => {
                    this.$loading(false);
                    console.log(err);
                });
        },

        setDataTag(id, tag) {
            this.id = id;
            this.tag = tag;
        }
    }
};
</script>

<style lang="scss" scoped>
.icon-delete,
.icon-edit {
    cursor: pointer;
}
.icon-delete:hover,
.icon-edit:hover {
    transform: scale(1.1);
}
</style>