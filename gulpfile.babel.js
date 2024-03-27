import gulp from 'gulp';
import sass from './gulp/sass.js';
import js from './gulp/webpack.js';
import fingerprint from './gulp/fingerprint-assets.js';

process.env.THEME = 'eshv';

gulp.task('scss-pipeline', sass);
gulp.task('js-pipeline', js);
gulp.task('build', gulp.series(sass, js, fingerprint));

gulp.task('default', () => {
  const src = './wp-content/themes/eshv/';
  gulp.watch([`${src}scss/**/*.scss`], sass);
  gulp.watch([`${src}js/**/*.js`], js);
});
