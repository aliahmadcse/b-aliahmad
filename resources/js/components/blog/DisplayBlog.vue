<template>
    <div>
        <div class="row" v-if="Object.keys($store.state.blog).length>0">
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

                <router-link
                    v-if="!preview"
                    class="text-link"
                    :to="{name:'tag.blogs',params:{page:1,tag:blog.tag.tag,tagId:blog.tag.id}}"
                >
                    <small>#{{ blog.tag.tag.toUpperCase() }}</small>
                </router-link>

                <a href="#" class="text-link" v-if="preview">
                    <small>#{{blog.tag.tag.toUpperCase()}}</small>
                </a>

                <div>
                    <p>{{ blogDate(blog.created_at) }}</p>
                </div>
            </div>
            <!-- blog title -->
            <div class="col-12 mt-2">
                <div class="blog-title text-md-center text-sm-left">
                    <h2>{{ blog.title }}</h2>
                </div>
            </div>
            <div class="col-12 mt-2 d-flex justify-content-center">
                <img :src="blog.image" title alt="header image" class="img-fluid" />
            </div>

            <!-- rendering the blog body -->
            <div class="col-md-8 offset-md-2 text-left mt-3 blog-body lead">
                <section v-for="(block,index) in blog.body.blocks" :key="index">
                    <!-- header -->
                    <h1 v-if="block.type=='header' && block.data.level==1">{{ block.data.text }}</h1>
                    <h2 v-if="block.type=='header' && block.data.level==2">{{ block.data.text }}</h2>
                    <h3 v-if="block.type=='header' && block.data.level==3">{{ block.data.text }}</h3>
                    <h4 v-if="block.type=='header' && block.data.level==4">{{ block.data.text }}</h4>
                    <h5 v-if="block.type=='header' && block.data.level==5">{{ block.data.text }}</h5>
                    <h6 v-if="block.type=='header' && block.data.level==6">{{ block.data.text }}</h6>

                    <!-- paragraph -->
                    <p v-if="block.type=='paragraph'">{{ block.data.text }}</p>

                    <!-- ordered list -->
                    <ol v-if="block.type=='list' && block.data.style=='ordered'">
                        <li v-for="(item,indexOrder) in block.data.items" :key="indexOrder">{{item}}</li>
                    </ol>

                    <!-- unordered list -->
                    <ul v-if="block.type=='list' && block.data.style=='unordered'">
                        <li
                            v-for="(item,indexUnOrder) in block.data.items"
                            :key="indexUnOrder"
                        >{{item}}</li>
                    </ul>
                </section>
                <script
                    src="https://gist.github.com/aliahmadcse/b5094aaff2bb7433959675ad057994c8.js"
                ><script>
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
            // is it the blog preview mode
            preview: false,
            blogId: 0
        };
    },

    created: function() {
        this.blogId = this.$route.params.id;
        if (this.$route.name.includes("preview")) {
            this.preview = true;
        }
    },

    mounted: async function() {
        this.$loading(true);
        await this.$store.dispatch("getBlog", this.blogId);
        this.$loading(false);
    },
    computed: {
        blog() {
            console.log(this.$store.state.blog);
            return this.$store.state.blog;
        }
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
    font-size: $font-size-base;
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