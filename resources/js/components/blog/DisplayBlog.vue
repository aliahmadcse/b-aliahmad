<template>
    <div>
        <div class="row" v-if="Object.keys(blog).length>0">
            <div class="col-12 blog-header d-flex justify-content-around">
                <div class="d-flex blog-author align-items-center">
                    <img
                        :src="blog.author.avatar"
                        class="author-avatar img-fluid rounded-circle mr-2"
                        alt="avatar"
                    />
                    <p class="card-text">
                        <a href="/" class="author-name text-gray">{{ blog.author.name }}</a>
                    </p>
                </div>
                <a href="#" class="text-link">
                    <small>#{{ blog.tag.tag }}</small>
                </a>
                <div>
                    <p>{{ blogDate(blog.created_at) }}</p>
                </div>
            </div>
            <div class="col-12 mt-2">
                <div class="blog-title text-md-center text-sm-left">
                    <h2 title>{{ blog.title }}</h2>
                </div>
            </div>
            <div class="col-12 mt-2 d-flex justify-content-center">
                <img :src="blog.image" title alt="header image" class="img-fluid" />
            </div>
            <div class="col-md-8 offset-md-2 text-left mt-3 blog-body">
                <p title class="lead">{{ blog.body }}</p>
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
            blogId: 0,
            blog: {}
        };
    },

    created: function() {
        this.blogId = this.$route.params.id;
    },

    mounted: function() {
        this.$loading(true);
        axios
            .get("/api/blog/" + this.blogId)
            .then(res => {
                this.blog = res.data;
                this.$loading(false);
            })
            .catch(err => {
                console.log(err);
                this.$loading(false);
            });
    }
};
</script>

<style lang="scss" scoped>
@import "~@/variables";
@import "~@/mixins";
.blog-title {
    font-family: $font-family-lexend-deca;
    font-weight: bold;
}
.author-avatar {
    max-width: 30px;
    max-height: 30px;
}
.author-name {
    text-decoration: none;
}
.blog-body {
    font-size: $font-size-base * 1.3;
}
@media (max-width: 350px) {
    .blog-header {
        flex-direction: column;
        align-items: center;
    }
    .blog-author {
        justify-content: center !important;
    }
}
</style>