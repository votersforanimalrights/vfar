import gulp from 'gulp';
import gutil from 'gulp-util';

export default () => {
  const src = './wp-content/themes/eshv/';

  const watchers = [
    gulp.watch(
      [`${src}scss/**/*.scss`],
      ['scss-pipeline'],
    ),
    gulp.watch(
      [`${src}js/**/*.js`],
      ['js-pipeline'],
    ),
  ];

  watchers.forEach((watcher) => {
    watcher.on('change', (event) => {
      gutil.log(`File ${event.path} was ${event.type}, running tasks...`);
    });
  });
};
