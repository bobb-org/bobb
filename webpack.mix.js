const mix = require('laravel-mix');
const path = require('path');

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

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
	.webpackConfig({
		resolve: {
			extensions: ['.js', '.ts', '.vue', '*'],
			alias: {
				'@': path.resolve(__dirname, 'resources/js/'),
				'~': path.resolve(__dirname, 'resources/sass/'),
				'@components': path.resolve(__dirname, 'resources/js/components/'),
				'@pages': path.resolve(__dirname, 'resources/js/pages/'),
			}
		}
	})
