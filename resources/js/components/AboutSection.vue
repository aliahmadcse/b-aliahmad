<template>
    <div class="about">
        <section class="header-image">
            <div class="row-1 row d-flex flex-row justify-content-center align-items-center">
                <div>
                    <img
                        class="image rounded-circle img-fluid img-thumbnail"
                        :src="user.avatar"
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
                <div class="col-12">
                    <article class="text-center mt-5">
                        <p>
                            Hi ✋, I am Ali Ahmad. I am a web developer 💻 and love developing websites with
                            <a
                                href="https://laravel.com/"
                                class="text-link"
                                target="_blank"
                            >Laravel</a> and
                            <a
                                href="https://vuejs.org/"
                                class="text-link"
                                target="_blank"
                            >Vue.js</a>.
                            I have over an year of experience in development. You may want to have a look at my
                            <a
                                href="/portfolio"
                                class="text-link"
                            >Portfolio</a>.
                            Besides this, I am an undergrad student in a well known univeristy of Pakistan, known
                            as
                            <a
                                href="https://www.uet.edu.pk/"
                                class="text-link"
                                target="_blank"
                            >UET Lahore</a> with majors in Computer Science 👨‍💻.
                        </p>
                    </article>
                    <article>
                        <p>My Expertise are:</p>
                        <ul>
                            <li>Laravel / Php</li>
                            <li>Vue.js</li>
                            <li>Relational Database (MySql)</li>
                            <li>Version Control (Git / Github)</li>
                            <li>Responsive Web Design</li>
                            <li>Python</li>
                        </ul>
                    </article>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import Typed from "typed.js";

export default {
    props: ["user"],

    // script for Typed
    mounted: function() {
        var typed = new Typed(".tag", {
            strings: [
                "Web Developer...",
                "Laravel and Vue.js...",
                "Undergrad Student..."
            ],
            typeSpeed: 30,
            backSpeed: 100,
            backDelay: 700
        });
    }
};
</script>

<style lang="scss" scoped>
@import "~@/variables";
@import "~@/mixins";

.tag {
    @include text-gradient;
}

@media (max-width: 800px) {
    .row-1 {
        flex-direction: column !important;
    }
}
</style>