<template>
    <div class="row mt-4">
        <div class="col-lg-9 offset-lg-2" v-for="blog in blogs" :key="blog.id">
            <div class="card mb-5 border-0" style>
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img :src="blog.image" class="card-img mt-4" alt />
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <p class="card-text tag">
                                <small>#{{ blog.tag.tag }}</small>
                            </p>

                            <h2 class="card-title">{{ blog.title }}</h2>
                            <p class="card-text card-description">{{ blog.description }}</p>
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img
                                        src="images/profile.jpg"
                                        class="author-avatar img-fluid rounded-circle mr-2"
                                        alt
                                    />
                                    <p class="card-text">
                                        <a href="/" class="author-name text-secondary">Ali Ahmad</a>
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
    </div>
</template>

<script>
export default {
    computed: {
        blogs: function() {
            return this.$store.state.blogs;
        }
    },

    methods: {
        blogDate: function(ISODate) {
            var months = [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December"
            ];
            let date = new Date(ISODate);
            return `${
                months[date.getMonth()]
            }/${date.getDate()}/${date.getFullYear()}`;
        }
    }
};
</script>

<style lang="scss" scoped>
@import "~@/variables.scss";

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
        font-size: $font-size-base * 1.6;
    }
    .card-description {
        color: $text-light;
        font-size: $font-size-base * 1.2;
    }
}
</style>