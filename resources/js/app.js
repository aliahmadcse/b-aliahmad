/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

require("./footer");

window.Vue = require("vue");

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context("./", true, /\.vue$/i);
// files.keys().map(key =>
//     Vue.component(
//         key
//             .split("/")
//             .pop()
//             .split(".")[0],
//         files(key).default
//     )
// );

Vue.component(
    "about-section",
    require("./components/AboutSection.vue").default
);
Vue.component(
    "display-projects",
    require("./components/portfolio/DisplayProjects.vue").default
);
Vue.component("blog-nav", require("./components/blog/BlogNav.vue").default);
Vue.component(
    "admin-navbar",
    require("./components/admin/AdminNavbar.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import store from "./store";

// global reuseable methods are defined in mixins
Vue.mixin({
    methods: {
        formatDateTime: function(ISODate) {
            let date = new Date(ISODate);
            return `${date.getFullYear()}-${date.getMonth() +
                1}-${date.getDate()} ${date.getHours()}:${date.getMinutes()}`;
        },

        formatTitle: function(title) {
            return title
                .replace(/\s+/g, "-")
                .replace(/[^\w-]+/g, "")
                .toLowerCase();
        },

        blogDate: function(ISODate) {
            const months = [
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
        },

        /**
         * This function capitalize the first letter of string
         * @param {string} str string to capitalize
         * @returns {string} a new string with first letter capitalized
         */
        capitalize: function(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        }
    }
});

const app = new Vue({
    el: "#app",
    // here, We make store instance available to all child components
    store
});
