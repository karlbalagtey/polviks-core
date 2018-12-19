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

mix.react('resources/js/app.js', 'public/js')
	.extract(['react', 'axios', 'popper.js'])
   	.sass('resources/sass/app.scss', 'public/css')
   	.sourceMaps()
   	.browserSync({
   		proxy: 'polviks-core.test',
   		files: [
   			'resources/js/**/*.js',
   			'resources/sass/**/*.scss',
   			'resources/views/**/*.php'
   		]
   	});
