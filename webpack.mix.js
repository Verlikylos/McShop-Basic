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

    .js(`${PATHS.src}/js/bootstrap/bootstrap.js`, `${PATHS.dist}/js/bootstrap.js`)
    .sass(`${PATHS.src}/scss/bootstrap/bootstrap.scss`, `${PATHS.dist}/css/themes/mcshop.css`)

    .copy(`node_modules/@fortawesome/fontawesome-free/css/all.css`, `${PATHS.dist}/css/fontawesome.css`)
    .copyDirectory(`node_modules/@fortawesome/fontawesome-free/webfonts`, `${PATHS.dist}/webfonts`)

    .copyDirectory(`${PATHS.src}/images`, `${PATHS.dist}/images`)
    .copyDirectory(`${PATHS.src}/fonts`, `${PATHS.dist}/fonts`)

    // .js(`${PATHS.src}/js/bootstrap/index.js`, `${PATHS.dist}/js/bootstrap.min.js`)
    // .copy(`${PATHS.src}/js/jasny-bootstrap.min.js`, `${PATHS.dist}/js/jasny-bootstrap.min.js`)
    // .copy(`${PATHS.src}/css`, `${PATHS.dist}/css`)
    // .sass(`${PATHS.src}/scss/themes/mcshop/mcshop.scss`, `${PATHS.dist}/css/themes/mcshop.min.css`)
    // .sass(`${PATHS.src}/scss/themes/cerulean/cerulean.scss`, `${PATHS.dist}/css/themes/cerulean.min.css`)
    // .sass(`${PATHS.src}/scss/themes/cosmo/cosmo.scss`, `${PATHS.dist}/css/themes/cosmo.min.css`)
    // .sass(`${PATHS.src}/scss/themes/cyborg/cyborg.scss`, `${PATHS.dist}/css/themes/cyborg.min.css`)
    // .sass(`${PATHS.src}/scss/themes/darkly/darkly.scss`, `${PATHS.dist}/css/themes/darkly.min.css`)
    // .sass(`${PATHS.src}/scss/themes/flatly/flatly.scss`, `${PATHS.dist}/css/themes/flatly.min.css`)
    // .sass(`${PATHS.src}/scss/themes/journal/journal.scss`, `${PATHS.dist}/css/themes/journal.min.css`)
    // .sass(`${PATHS.src}/scss/themes/litera/litera.scss`, `${PATHS.dist}/css/themes/litera.min.css`)
    // .sass(`${PATHS.src}/scss/themes/lumen/lumen.scss`, `${PATHS.dist}/css/themes/lumen.min.css`)
    // .sass(`${PATHS.src}/scss/themes/lux/lux.scss`, `${PATHS.dist}/css/themes/lux.min.css`)
    // .sass(`${PATHS.src}/scss/themes/materia/materia.scss`, `${PATHS.dist}/css/themes/materia.min.css`)
    // .sass(`${PATHS.src}/scss/themes/minty/minty.scss`, `${PATHS.dist}/css/themes/minty.min.css`)
    // .sass(`${PATHS.src}/scss/themes/pulse/pulse.scss`, `${PATHS.dist}/css/themes/pulse.min.css`)
    // .sass(`${PATHS.src}/scss/themes/sandstone/sandstone.scss`, `${PATHS.dist}/css/themes/sandstone.min.css`)
    // .sass(`${PATHS.src}/scss/themes/simplex/simplex.scss`, `${PATHS.dist}/css/themes/simplex.min.css`)
    // .sass(`${PATHS.src}/scss/themes/sketchy/sketchy.scss`, `${PATHS.dist}/css/themes/sketchy.min.css`)
    // .sass(`${PATHS.src}/scss/themes/slate/slate.scss`, `${PATHS.dist}/css/themes/slate.min.css`)
    // .sass(`${PATHS.src}/scss/themes/solar/solar.scss`, `${PATHS.dist}/css/themes/solar.min.css`)
    // .sass(`${PATHS.src}/scss/themes/spacelab/spacelab.scss`, `${PATHS.dist}/css/themes/spacelab.min.css`)
    // .sass(`${PATHS.src}/scss/themes/superhero/superhero.scss`, `${PATHS.dist}/css/themes/superhero.min.css`)
    // .sass(`${PATHS.src}/scss/themes/united/united.scss`, `${PATHS.dist}/css/themes/united.min.css`)
    // .sass(`${PATHS.src}/scss/themes/yeti/yeti.scss`, `${PATHS.dist}/css/themes/yeti.min.css`)
    // .copy(`${PATHS.src}/images`, `${PATHS.dist}/images`)
    // .copy(`${PATHS.src}/webfonts`, `${PATHS.dist}/webfonts`)

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
