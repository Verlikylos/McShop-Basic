const mix = require('laravel-mix');

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

const PATHS = {
    src: 'resources',
    dist: 'public',
    proxy: 'https://mcshop-basic.test/'
};

mix
    .setPublicPath(PATHS.dist)
    .options({ processCssUrls: false })

    .copy(`${PATHS.src}/js/datatables.min.js`, `${PATHS.dist}/js/datatables.min.js`)
    .js(`${PATHS.src}/js/bootstrap/index.js`, `${PATHS.dist}/js/bootstrap.min.js`)

    .copy(`${PATHS.src}/css`, `${PATHS.dist}/css`)
    .sass(`${PATHS.src}/scss/themes/vmcshop/vmcshop.scss`, `${PATHS.dist}/css/themes/vmcshop.min.css`)

    .copy(`${PATHS.src}/images`, `${PATHS.dist}/images`)
    .copy(`${PATHS.src}/webfonts`, `${PATHS.dist}/webfonts`)

    .version()
    .sourceMaps()

    .browserSync({
        open: true,
        ui: false,
        injectChanges: true,
        notify: false,
        host: 'localhost',
        port: 8080,
        proxy: `${PATHS.proxy}`,
        logLevel: 'silent',
        files: [`${PATHS.src}/views/**/*.*`, `${PATHS.dist}/**/*.*`]
    });
