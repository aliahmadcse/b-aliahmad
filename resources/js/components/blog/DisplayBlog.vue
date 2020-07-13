<template>
    <div>
        <div class="row" v-if="Object.keys($store.state.blog).length>0" title>
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
            <div class="col-12 my-3 d-flex justify-content-center">
                <img :src="blog.image" title alt="header image" class="img-fluid" />
            </div>

            <!-- rendering the blog body -->
            <div class="col-md-8 offset-md-2 text-left mt-3 blog-body lead">
                <section v-for="(block,index) in blog.body.blocks" :key="index">
                    <!-- header -->
                    <h1 v-if="block.type=='header' && block.data.level==1">{{ block.data.text }}</h1>
                    <h2
                        v-else-if="block.type=='header' && block.data.level==2"
                    >{{ block.data.text }}</h2>
                    <h3
                        v-else-if="block.type=='header' && block.data.level==3"
                    >{{ block.data.text }}</h3>
                    <h4
                        v-else-if="block.type=='header' && block.data.level==4"
                    >{{ block.data.text }}</h4>
                    <h5
                        v-else-if="block.type=='header' && block.data.level==5"
                    >{{ block.data.text }}</h5>
                    <h6
                        v-else-if="block.type=='header' && block.data.level==6"
                    >{{ block.data.text }}</h6>

                    <!-- paragraph -->
                    <p v-else-if="block.type=='paragraph'" v-html="block.data.text"></p>

                    <!-- ordered list -->
                    <ol v-else-if="block.type=='list' && block.data.style=='ordered'">
                        <li
                            v-for="(item,indexOrder) in block.data.items"
                            :key="indexOrder"
                            v-html="item"
                        ></li>
                    </ol>

                    <!-- unordered list -->
                    <ul v-else-if="block.type=='list' && block.data.style=='unordered'">
                        <li
                            v-for="(item,indexUnOrder) in block.data.items"
                            :key="indexUnOrder"
                            v-html="item"
                        ></li>
                    </ul>

                    <!-- code -->
                    <pre v-else-if="block.type=='code'" v-highlightjs="block.data.code"><code></code></pre>

                    <!-- delimiter -->
                    <div class="ce-delimiter cdx-block" v-if="block.type=='delimiter'"></div>
                </section>
            </div>
        </div>
    </div>
</template>

<script>
import VueLoading from "vuejs-loading-plugin";
Vue.use(VueLoading);
import hljs from "highlight.js";
import "highlight.js/styles/shades-of-purple.css";

// vue custom directive for heighlight js
Vue.directive("highlightjs", {
    deep: true,
    bind: function(el, binding) {
        // on first bind, highlight all targets
        let targets = el.querySelectorAll("code");
        targets.forEach(target => {
            // if a value is directly assigned to the directive, use this
            // instead of the element content.
            if (binding.value) {
                target.textContent = binding.value;
            }
            hljs.highlightBlock(target);
        });
    },
    componentUpdated: function(el, binding) {
        // after an update, re-fill the content and then highlight
        let targets = el.querySelectorAll("code");
        targets.forEach(target => {
            if (binding.value) {
                target.textContent = binding.value;
                hljs.highlightBlock(target);
            }
        });
    }
});

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
    font-size: $font-size-base * 1.2;
}
pre {
    font-size: $font-size-base * 1.1;
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