const { mix } = require('laravel-mix');

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

// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css');

mix.styles([
    // 'resources/assets/css/animate.min.css',
    'resources/assets/css/bootstrap.min.css',
    'resources/assets/css/style.css',
    // 'resources/assets/css/morris.css',
    // 'resources/assets/css/light-bootstrap-dashboard.css',
    // 'resources/assets/css/paper-dashboard.css',
    'resources/assets/css/select2.min.css',
    'resources/assets/css/select2-bootstrap.min.css',
    'resources/assets/css/sweetalert.css',
    'resources/assets/css/themify-icons.css',
    'resources/assets/css/pe-icon-7-stroke.css',
    'resources/assets/css/lightbox.css',
    'resources/assets/css/tabs.css',
    'resources/assets/css/tabstyles.css',
    // 'resources/assets/css/fresh-bootstrap-table.css',
    //  'resources/assets/css/daterangepicker.css',
], 'public/css/all.css')
.js([
    // 'resources/assets/js/jquery-1.10.2.js',
    'resources/assets/js/app.js',
    // 'resources/assets/js/bootstrap.js',
    'resources/assets/js/bootstrap-checkbox-radio.js',
    'resources/assets/js/bootstrap-checkbox-radio-switch.js',
    'resources/assets/js/bootstrap-notify.js',
    'resources/assets/js/bootstrap-select.js',
    // 'resources/assets/js/paper-dashboard.js',
    // 'resources/assets/js/light-bootstrap-dashboard.js',
    'resources/assets/js/select2.full.js',
    'resources/assets/js/select2.min.js',
    'resources/assets/js/sweetalert.min.js',
    'resources/assets/js/bootstrap-filestyle.min.js',
    'resources/assets/js/lightbox.js',
    'resources/assets/js/custom.js',
    // 'resources/assets/js/cbpFWTabs.js',
    // 'resources/assets/js/bootstrap-table.js',
    //  'resources/assets/js/daterangepicker.js',
], 'public/js/all.js');