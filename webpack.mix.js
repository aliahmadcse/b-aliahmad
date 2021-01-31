const mix = require("laravel-mix");

const path = require("path");
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

//  here, I configure the webpack to to resolve the path to sass
// partials, so I can include them in vue components

mix.js("resources/js/app.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .webpackConfig({
        resolve: {
            alias: {
                "@": path.resolve("resources/sass")
            }
        }
    });

//versioning of assets in production for better experience

// if (mix.inProduction()) {
//     mix.version();
// }

//hot reloading
mix.browserSync("b-aliahmad.test");

// disabling mix compile notifications, which might be headache
mix.disableNotifications();
