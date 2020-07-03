<template>
    <div>
        <div class="row mb-3">
            <div class="col-lg-3 col-md-12">
                <router-link
                    class="btn btn-outline-secondary mb-3 ml-3"
                    :to="{name:'blogs.add'}"
                >Add New Blog</router-link>
            </div>
            <div class="col-lg-9 col-md-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-search text-secondary"></i>
                        </span>
                    </div>
                    <input
                        type="search"
                        class="form-control"
                        placeholder="Search Blog..."
                        aria-label="search blog"
                        aria-describedby="search blog"
                        v-model="search"
                    />
                </div>
            </div>
        </div>

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
                <tbody id="table-body">
                    <tr v-for="blog in blogs" :key="blog.id" id="table-row">
                        <td scope="row" id="blog-title">{{ blog.title }}</td>
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
    data() {
        return {
            search: ""
        };
    },

    async created() {
        // using lodash method to check for an empty object
        if (this.$store.state.blogPosts.length == 0) {
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
                        this.$store.commit("SET_BLOG_POSTS", res.data);
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
            return this.$store.state.blogPosts;
        }
    },

    watch: {
        // on change of search data item, an event will cause this
        // method to execute, passing the search term value to it
        search: function(searchItem) {
            // using jquery to filter the DOM for searched item
            $("#table-body #blog-title").each(function() {
                let titleStr = $(this)
                    .text()
                    .toLowerCase();

                $(this)
                    .closest("#table-row")
                    [titleStr.includes(searchItem) ? "show" : "hide"]();
            });
        }
    }
};
</script>

<style lang="scss" scoped>
.icon-edit:hover {
    transform: scale(1.1);
}
</style>