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
    </div>
</template>

<script>
import Typed from "typed.js";

export default {
    mounted: function() {
        var typed = new Typed(".tag", {
            strings: ["Ali Ahmad.", "Web Developer.", "Undergrad Student."],
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