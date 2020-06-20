<template>
    <div class="row mt-4">
        <div class="col-lg-9 offset-lg-2" v-for="blog in blogs.data" :key="blog.id">
            <div class="card mb-5 border-0" style>
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img :src="blog.image" class="card-img mt-4" alt />
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <p class="card-text tag">
                                <a href="#" class="text-link">
                                    <small>#{{ blog.tag.tag }}</small>
                                </a>
                            </p>

                            <router-link
                                :to="{name:'blog.display',params:{title:formatTitle(blog.title),id:blog.id}}"
                                class="text-decoration-none"
                            >
                                <h2 class="card-title">{{ blog.title }}</h2>
                            </router-link>
                            <p class="card-text card-description">{{ blog.description }}</p>
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img
                                        :src="blog.author.avatar"
                                        class="author-avatar img-fluid rounded-circle mr-2"
                                        alt
                                    />
                                    <p class="card-text">
                                        <a
                                            href="/"
                                            class="author-name text-gray"
                                        >{{ blog.author.name }}</a>
                                    </p>
                                </div>
                                <p class="card-text">
                                    <small class="text-muted">{{ blogDate(blog.created_at) }}</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- laravel-vue-pagination -->
        <div class="col-12">
            <div class="d-flex justify-content-end">
                <pagination :show-disabled="true" :data="blogs" @pagination-change-page="getBlogs"></pagination>
            </div>
        </div>
    </div>
</template>

<script>
import laravelVuePagination from "laravel-vue-pagination";
import VueLoading from "vuejs-loading-plugin";
Vue.use(VueLoading);

export default {
    data: function() {
        return {};
    },

    components: {
        pagination: laravelVuePagination
    },

    mounted: function() {
        this.getBlogs();
    },

    computed: {
        page: function() {
            return this.$route.params.page ? this.$route.params.page : 1;
        },

        blogs: function() {
            return this.$store.state.tagBlogs;
        },

        tagId: function() {
            return this.$route.params.tagId;
        },

        blogTag: function() {
            return this.$route.params.tag;
        }
    },

    methods: {
        // this.page is a default argument, only used when no
        // argument is passed to this function
        getBlogs: function(page = this.page) {
            this.$loading(true);
            axios
                .get("/api/blogsByTag/" + this.tagId + "?page=" + page)
                .then(res => {
                    this.$store.commit("SET_TAG_BLOGS", res.data);
                    this.$loading(false);
                    this.routePush(page);
                    window.scroll({
                        top: 0,
                        behavior: "smooth"
                    });
                })
                .catch(err => {
                    console.log(err);
                });
        },

        routePush: function(page) {
            this.$router
                .push({
                    name: "tag.blogs",
                    params: {
                        page,
                        tag: this.blogTag,
                        tagId: this.tagId
                    }
                })
                .catch(err => {});
        },

        formatTitle: function(title) {
            return title.replace(/\s+/g, "-").toLowerCase();
        }
    }
};
</script>

<style lang="scss" scoped>
@import "~@/variables.scss";
@import "~@/mixins.scss";

.card {
    .tag {
        margin: 1px;
    }
    .card-img {
        height: 200px;
    }
    .author-avatar {
        max-width: 30px;
        max-height: 30px;
    }
    .author-name {
        text-decoration: none;
    }
    .card-title {
        color: $github;
        font-family: $font-family-montserrat;
        font-size: $font-size-base * 1.7;
    }
    .card-title:hover {
        @include text-gradient;
    }

    .card-description {
        color: $text-light;
        font-size: $font-size-base * 1.2;
    }
}
</style>
