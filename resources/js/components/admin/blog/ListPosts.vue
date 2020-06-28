<template>
    <div>
        <router-link
            class="btn btn-outline-secondary mb-3 ml-3"
            :to="{name:'blogs.add'}"
        >Add New Blog</router-link>
        <!-- table for listing blog posts -->
        <div class="table-responsive">
            <table class="table table-striped text-center table-project-list">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Tag</th>
                        <th scope="col">Published</th>
                        <th scope="col" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="blog in blogs" :key="blog.id">
                        <td scope="row">{{ blog.title }}</td>
                        <td scope="row">{{ blog.tag.tag }}</td>
                        <td scope="row">{{ blog.is_published?'Yes':'No' }}</td>
                        <td scope="row">
                            <router-link class="mr-3" :to="{name:'blogs.edit',params:{id:blog.id}}">
                                <i class="far fa-edit icon-edit text-secondary"></i>
                            </router-link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import VueLoading from "vuejs-loading-plugin";
Vue.use(VueLoading);

export default {
    async created() {
        // using lodash method to check for an empty object
        if (_.isEmpty(this.$store.state.blogs)) {
            this.$loading(true);
            await this.getBlogs();
            this.$loading(false);
        }
    },
    methods: {
        getBlogs() {
            return new Promise((resolve, reject) => {
                axios
                    .get("/api/blogs/all")
                    .then(res => {
                        this.$store.commit("SET_BLOGS", res.data);
                        resolve();
                    })
                    .catch(err => {
                        console.log(err);
                        reject();
                    });
            });
        }
    },

    computed: {
        blogs() {
            if (!_.isEmpty(this.$store.state.blogs))
                return this.$store.state.blogs;
        }
    }
};
</script>

<style lang="scss" scoped>
</style>