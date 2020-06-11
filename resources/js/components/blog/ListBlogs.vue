<template>
    <div class="row mt-4">
        <div class="col-lg-9 offset-lg-2" v-for="blog in blogs" :key="blog.id">
            <div class="card mb-5 border-0" style>
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img :src="blog.image" class="card-img mt-4 mr-5" alt />
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <p class="card-text tag">
                                <small>#{{ blog.tag.tag }}</small>
                            </p>

                            <h2 class="card-title">{{ blog.title }}</h2>
                            <p class="card-text">{{ blog.description }}</p>
                            <p class="card-text float-right">
                                <small class="text-muted">{{ blogDate(blog.created_at) }}</small>
                            </p>
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
    img {
        height: 200px;
    }
}
</style>