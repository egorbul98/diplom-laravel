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

mix.js('resources/js/index.js', 'public/js')
    .sass('resources/sass/style.scss', 'public/css')
    .options({
      postCss: [
         require('autoprefixer')({
            browsers: ['last 40 versions'],
               grid: true
            })
      ]
    });
// .options({
//    autoprefixer: {
//       options: {
//          browsers: [
//             'last 20 versions', // Set really far back in hopes of generating old prefixes
//             'ie 10-11'          // Getting specific
//          ],
//          options: {
//             flex: true,
//         }
//       }
//    }
// });
