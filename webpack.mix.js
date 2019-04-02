const mix = require('laravel-mix')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .version()

/*
 |--------------------------------------------------------------------------
 | Plugins
 |--------------------------------------------------------------------------
 */

const LiveReloadPlugin = require('webpack-livereload-plugin')

mix.webpackConfig({
    plugins: [new LiveReloadPlugin()],

    output: {
        chunkFilename: 'js/chunks/chunk-[name].js',
    },
})
