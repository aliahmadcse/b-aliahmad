const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js").sass(
    "resources/sass/app.scss",
    "public/css"
);

//versioning of assets in production for better experience
if (mix.inProduction()) {
    mix.version();
}

//hot reloading
mix.browserSync("aliahmad.test");

// disabling mix compile notifications, which might be headache
mix.disableNotifications();
