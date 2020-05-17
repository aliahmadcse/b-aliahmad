<template>
    <div class="about">
        <section class="header-image">
            <div class="row-1 row d-flex flex-row justify-content-center align-items-center">
                <div>
                    <img
                        class="image rounded-circle img-fluid img-thumbnail"
                        src="/images/profile.jpg"
                        alt="profile"
                    />
                </div>
                <div>
                    <span class="tagline m-5">
                        <p class="tag text-gray"></p>
                    </span>
                </div>
            </div>
        </section>
        <section class="intro">
            <div class="row">
                <div class="col-12 text-center mt-3">
                    <article class="lead">
                        <p>Hi ✋, I am Ali Ahmad</p>
                        <a href="#" class="text-link">Laravel</a>
                    </article>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import Typed from "typed.js";

export default {
    mounted: function() {
        var typed = new Typed(".tag", {
            strings: [
                "Web Developer.",
                "Laravel and Vue.js.",
                "Undergrad Student."
            ],
            typeSpeed: 30,
            backSpeed: 100,
            backDelay: 700
        });
    }
};
</script>

<style scoped>
@media (max-width: 800px) {
    .row-1 {
        flex-direction: column !important;
    }
}
</style>