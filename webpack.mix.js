const mix = require('laravel-mix');

if (process.env.NODE_ENV == 'development') {
    mix.webpackConfig({ devtool: "inline-source-map" });
    mix.sourceMaps();
    mix.browserSync({
        proxy: 'osa.grafiq.hu',
        files: ['resources/**/*'],
        port: 5000
    });
}
else if (process.env.NODE_ENV == 'production') {
    mix.options({
    });
}

mix.js('resources/js/scripts.js', 'js')
    .sass('resources/sass/style.scss', 'css').options({
    })
    .copyDirectory('resources/images', 'public/images')
;
