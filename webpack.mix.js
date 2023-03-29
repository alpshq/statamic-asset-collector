const mix = require('laravel-mix');

mix
  .js('resources/js/bookmarker.js', 'dist/js')
  .postCss('resources/css/bookmarker.pcss', 'dist/css', [
    require('postcss-nested'),
  ])
  .sourceMaps()
  .copyDirectory('dist', '../../public/vendor/statamic-bookmarker')
  .disableNotifications();
